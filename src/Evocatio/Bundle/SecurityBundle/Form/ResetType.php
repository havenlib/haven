<?php


/*
 * This file is part of the Evocatio package.
 *
 * (c) Stéphan Champagne <sc@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ResetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
        ;
    }

    public function getName()
    {
        return 'evocatio_bundle_securitybundle_resettype';
    }
}
