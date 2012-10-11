<?php

namespace Evocatio\Bundle\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password')
//            ->add('salt')
//            ->add('locked')
//            ->add('status')
//            ->add('created_at')
//            ->add('created_by')
//            ->add('contact')
        ;
    }

    public function getName()
    {
        return 'evocatio_bundle_securitybundle_logintype';
    }
}
