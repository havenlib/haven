<?php

namespace Evocatio\Bundle\PersonaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class WebType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('web')
            ->add('type')
        ;
    }

    public function getName()
    {
        return 'evocatio_bundle_contactbundle_webtype';
    }
}
