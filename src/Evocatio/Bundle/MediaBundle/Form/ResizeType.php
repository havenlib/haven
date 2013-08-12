<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Laurent Breleur <lbreleur@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ResizeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('height', null, array("required" => false))
                ->add('width', null, array("required" => false))
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn save-btn'),
                    'label' => 'resize.image'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array());
    }

    public function getName() {
        return 'evocatio_mediabundle_resizetype';
    }

}
