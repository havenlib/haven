<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Form\Extension\Validator\ViolationMapper;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Util\VirtualFormAwareIterator;
use Symfony\Component\PropertyAccess\PropertyPathIterator;
use Symfony\Component\PropertyAccess\PropertyPathBuilder;
use Symfony\Component\PropertyAccess\PropertyPathIteratorInterface;
use Symfony\Component\Form\Extension\Validator\ViolationMapper\ViolationPathIterator;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ViolationMapper implements ViolationMapperInterface
{
    /**
     * @var Boolean
     */
    private $allowNonSynchronized;

    /**
     * {@inheritdoc}
     */
    public function mapViolation(ConstraintViolation $violation, FormInterface $form, $allowNonSynchronized = false)
    {
        $this->allowNonSynchronized = $allowNonSynchronized;

        // The scope is the currently found most specific form that
        // an error should be mapped to. After setting the scope, the
        // mapper will try to continue to find more specific matches in
        // the children of scope. If it cannot, the error will be
        // mapped to this scope.
        $scope = null;

        $violationPath = null;
        $relativePath = null;
        $match = false;

        // Don't create a ViolationPath instance for empty property paths
        if (strlen($violation->getPropertyPath()) > 0) {
            $violationPath = new ViolationPath($violation->getPropertyPath());
            $relativePath = $this->reconstructPath($violationPath, $form);
        }

        // This case happens if the violation path is empty and thus
        // the violation should be mapped to the root form
        if (null === $violationPath) {
            $scope = $form;
        }

        // In general, mapping happens from the root form to the leaf forms
        // First, the rules of the root form are applied to determine
        // the subsequent descendant. The rules of this descendant are then
        // applied to find the next and so on, until we have found the
        // most specific form that matches the violation.

        // If any of the forms found in this process is not synchronized,
        // mapping is aborted. Non-synchronized forms could not reverse
        // transform the value entered by the user, thus any further violations
        // caused by the (invalid) reverse transformed value should be
        // ignored.

        if (null !== $relativePath) {
            // Set the scope to the root of the relative path
            // This root will usually be $form. If the path contains
            // an unmapped form though, the last unmapped form found
            // will be the root of the path.
            $scope = $relativePath->getRoot();
            $it = new PropertyPathIterator($relativePath);

            while ($this->acceptsErrors($scope) && null !== ($child = $this->matchChild($scope, $it))) {
                $scope = $child;
                $it->next();
                $match = true;
            }
        }

        // This case happens if an error happened in the data under a
        // virtual form that does not match any of the children of
        // the virtual form.
        if (null !== $violationPath && !$match) {
            // If we could not map the error to anything more specific
            // than the root element, map it to the innermost directly
            // mapped form of the violation path
            // e.g. "children[foo].children[bar].data.baz"
            // Here the innermost directly mapped child is "bar"

            $scope = $form;
            $it = new ViolationPathIterator($violationPath);

            while ($this->acceptsErrors($scope) && $it->valid() && $it->mapsForm()) {
                if (!$scope->has($it->current())) {
                    // Break if we find a reference to a non-existing child
                    break;
                }

                $scope = $scope->get($it->current());
                $it->next();
            }
        }

        // Follow dot rules until we have the final target
        $mapping = $scope->getConfig()->getOption('error_mapping');

        while ($this->acceptsErrors($scope) && isset($mapping['.'])) {
            $dotRule = new MappingRule($scope, '.', $mapping['.']);
            $scope = $dotRule->getTarget();
            $mapping = $scope->getConfig()->getOption('error_mapping');
        }

        // Only add the error if the form is synchronized
        if ($this->acceptsErrors($scope)) {
            $scope->addError(new FormError(
                $violation->getMessage(),
                $violation->getMessageTemplate(),
                $violation->getMessageParameters(),
                $violation->getMessagePluralization()
            ));
        }
    }

    /**
     * Tries to match the beginning of the property path at the
     * current position against the children of the scope.
     *
     * If a matching child is found, it is returned. Otherwise
     * null is returned.
     *
     * @param FormInterface                 $form The form to search.
     * @param PropertyPathIteratorInterface $it   The iterator at its current position.
     *
     * @return null|FormInterface The found match or null.
     */
    private function matchChild(FormInterface $form, PropertyPathIteratorInterface $it)
    {
        // Remember at what property path underneath "data"
        // we are looking. Check if there is a child with that
        // path, otherwise increase path by one more piece
        $chunk = '';
        $foundChild = null;
        $foundAtIndex = 0;

        // Construct mapping rules for the given form
        $rules = array();

        foreach ($form->getConfig()->getOption('error_mapping') as $propertyPath => $targetPath) {
            // Dot rules are considered at the very end
            if ('.' !== $propertyPath) {
                $rules[] = new MappingRule($form, $propertyPath, $targetPath);
            }
        }

        // Ignore virtual forms when iterating the children
        $childIterator = new \RecursiveIteratorIterator(
            new VirtualFormAwareIterator($form->all())
        );

        // Make the path longer until we find a matching child
        while (true) {
            if (!$it->valid()) {
                return null;
            }

            if ($it->isIndex()) {
                $chunk .= '[' . $it->current() . ']';
            } else {
                $chunk .= ('' === $chunk ? '' : '.') . $it->current();
            }

            // Test mapping rules as long as we have any
            foreach ($rules as $key => $rule) {
                /* @var MappingRule $rule */

                // Mapping rule matches completely, terminate.
                if (null !== ($form = $rule->match($chunk))) {
                    return $form;
                }

                // Keep only rules that have $chunk as prefix
                if (!$rule->isPrefix($chunk)) {
                    unset($rules[$key]);
                }
            }

            // Test children unless we already found one
            if (null === $foundChild) {
                foreach ($childIterator as $child) {
                    /* @var FormInterface $child */
                    $childPath = (string) $child->getPropertyPath();

                    // Child found, mark as return value
                    if ($chunk === $childPath) {
                        $foundChild = $child;
                        $foundAtIndex = $it->key();
                    }
                }
            }

            // Add element to the chunk
            $it->next();

            // If we reached the end of the path or if there are no
            // more matching mapping rules, return the found child
            if (null !== $foundChild && (!$it->valid() || count($rules) === 0)) {
                // Reset index in case we tried to find mapping
                // rules further down the path
                $it->seek($foundAtIndex);

                return $foundChild;
            }
        }

        return null;
    }

    /**
     * Reconstructs a property path from a violation path and a form tree.
     *
     * @param  ViolationPath $violationPath The violation path.
     * @param  FormInterface $origin        The root form of the tree.
     *
     * @return RelativePath The reconstructed path.
     */
    private function reconstructPath(ViolationPath $violationPath, FormInterface $origin)
    {
        $propertyPathBuilder = new PropertyPathBuilder($violationPath);
        $it = $violationPath->getIterator();
        $scope = $origin;

        // Remember the current index in the builder
        $i = 0;

        // Expand elements that map to a form (like "children[address]")
        for ($it->rewind(); $it->valid() && $it->mapsForm(); $it->next()) {
            if (!$scope->has($it->current())) {
                // Scope relates to a form that does not exist
                // Bail out
                break;
            }

            // Process child form
            $scope = $scope->get($it->current());

            if ($scope->getConfig()->getVirtual()) {
                // Form is virtual
                // Cut the piece out of the property path and proceed
                $propertyPathBuilder->remove($i);
            } elseif (!$scope->getConfig()->getMapped()) {
                // Form is not mapped
                // Set the form as new origin and strip everything
                // we have so far in the path
                $origin = $scope;
                $propertyPathBuilder->remove(0, $i + 1);
                $i = 0;
            } else {
                /* @var \Symfony\Component\PropertyAccess\PropertyPathInterface $propertyPath */
                $propertyPath = $scope->getPropertyPath();

                if (null === $propertyPath) {
                    // Property path of a mapped form is null
                    // Should not happen, bail out
                    break;
                }

                $propertyPathBuilder->replace($i, 1, $propertyPath);
                $i += $propertyPath->getLength();
            }
        }

        $finalPath = $propertyPathBuilder->getPropertyPath();

        return null !== $finalPath ? new RelativePath($origin, $finalPath) : null;
    }

    /**
     * @param FormInterface $form
     *
     * @return Boolean
     */
    private function acceptsErrors(FormInterface $form)
    {
        return $this->allowNonSynchronized || $form->isSynchronized();
    }
}
