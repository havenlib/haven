<?php

namespace Evocatio\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('translations', 'collection', array('type' => new PageTranslationType()))
                ->add('htmlcontents', "collection", array(
                    'type' => new HtmlContentType(),
                    'allow_add' => true,
                    'prototype' => true,
                    // Post update
                    'by_reference' => true,
                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
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
