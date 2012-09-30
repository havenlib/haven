<?php

namespace Evocatio\Bundle\PersonaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PostalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('master')
            ->add('address')
            ->add('address2')
            ->add('ville')
        ;
    }

    public function getName()
    {
        return 'evocatio_bundle_contactbundle_postaltype';
    }
}
