<?php

namespace Evocatio\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('translations', 'translation', array(
                    'type' => new PageTranslationType()
                    , 'allow_add' => true
                    , "label" => false
                    , 'prototype' => true
                    , 'prototype_name' => '__name_trans__'
                    , 'by_reference' => false
                    , 'options' => array(
                        'label' => false
                    )
//                    need to put the data class to have default from the entity
                    , 'empty_data' =>  "\Evocatio\Bundle\CmsBundle\Entity\PageTranslation"
                ))
                ->add('template')
                ->add('html_contents', "collection", array(
                    'type' => new PageContentType('Evocatio\Bundle\CmsBundle\Form\HtmlContentType')
                    , 'allow_add' => true
                    , "label" => false
                    , 'allow_delete' => true
                    , 'prototype' => true
                    , 'by_reference' => false
                    , 'options' => array(
                        'label' => false
                    )
                ))
                ->add('text_contents', "collection", array(
                    'type' => new PageContentType('Evocatio\Bundle\CmsBundle\Form\TextContentType')
                    , 'allow_add' => true
                    , "label" => false
                    , 'allow_delete' => true
                    , 'prototype' => true
                    , 'by_reference' => false
                    , 'options' => array(
                        'label' => false
                    )
                ))
                ->add('news_widgets', "collection", array(
                    'type' => new PageContentType('Evocatio\Bundle\CmsBundle\Form\NewsWidgetType')
                    , 'allow_add' => true
                    , "label" => false
                    , 'allow_delete' => true
                    , 'prototype' => true
                    , 'by_reference' => false
                    , 'options' => array(
                        'label' => false
                    )
                ))
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn save-btn'),
                    'label' => 'save.page'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\CmsBundle\Entity\Page'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_cmsbundle_pagetype';
    }

}
