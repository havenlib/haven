<?php

namespace Evocatio\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FaqTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', "textarea",  array("required" => false))
            ->add('reponse', "textarea",  array("required" => false))
        ;
    }

    public function getName()
    {
        return 'evocatio_bundle_faqbundle_faqtranslationtype';
    }
}
