<?php

namespace Evocatio\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TextContentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('status')
                ->add('translations', 'translation', array(
                    'type' => new TextContentTranslationType()
                    , 'allow_add' => true
                    , "label" => false
                    , 'prototype' => true
                    , 'prototype_name' => '__name_trans__'
                    , 'by_reference' => false
                    , 'options' => array(
                        'label' => false
                    )
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\CmsBundle\Entity\TextContent'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_cmsbundle_textcontenttype';
    }

}
