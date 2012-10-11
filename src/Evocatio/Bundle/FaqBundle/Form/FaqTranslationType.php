<?php

namespace Evocatio\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FaqTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', "textarea",  array("required" => false))
            ->add('reponse', "textarea",  array("required" => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\FaqBundle\Entity\FaqTranslation'
        ));
    }

    public function getName()
    {
        return 'evocatio_bundle_faqbundle_faqtranslationtype';
    }
}