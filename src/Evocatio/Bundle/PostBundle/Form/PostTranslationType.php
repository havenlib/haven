<?php

namespace Evocatio\Bundle\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

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
            ->add('file', "file", array('required' => false))
//            ->add('slug', "textarea", array('required' => false))
        ;
    }

    public function getName()
    {
        return 'evocatio_bundle_postbundle_posttranslationtype';
    }
}
