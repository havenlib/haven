<?php

namespace Evocatio\Bundle\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', "text", array('required' => false))
            ->add('title', "text", array('required' => false))
            ->add('excerpt', "text", array('required' => false))
            ->add('subtitle', "text", array('required' => false))
            ->add('content', "textarea", array('required' => false))
            ->add('file', "file", array('required' => false, "attr" => array("multiple" => true)))
//            ->add('slug', "textarea", array('required' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PostBundle\Entity\PostTranslation'
        ));
    }

    public function getName()
    {
        return 'evocatio_bundle_postbundle_posttranslationtype';
    }
}
