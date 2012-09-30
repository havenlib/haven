<?php

namespace Evocatio\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class LanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('symbol')
            ->add('status')
        ;
    }

    public function getName()
    {
        return 'evocatio_bundle_corebundle_languagetype';
    }
}
