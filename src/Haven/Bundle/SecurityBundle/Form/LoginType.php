<?php

/*
 * This file is part of the Haven package.
 *
 * (c) Stéphan Champagne <sc@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Haven\Bundle\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username')
                ->add('password', 'password')
                ->add('remember', 'checkbox', array(
                    'label' => 'remember.me'
                    , 'required' => false
                ))
                ->add('send', 'submit', array(
                    'label' => 'OPEN'
                ))
        ;
    }

    public function getName() {
        return 'haven_bundle_securitybundle_logintype';
    }

}
