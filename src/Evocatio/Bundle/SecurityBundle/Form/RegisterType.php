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

// Symfony includes
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\AbstractType;
// Evocatio includes
use Evocatio\Bundle\PersonaBundle\Form\ContactNoAddressType;

/**
 * Description of LoginType
 *
 * @author themaster
 */
class RegisterType extends \Evocatio\Bundle\SecurityBundle\Form\UserType {

    public function buildForm(FormBuilder $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
                ->add('contact', new ContactNoAddressType())

        ;
    }

    public function getName() {
        return 'register';
    }

}