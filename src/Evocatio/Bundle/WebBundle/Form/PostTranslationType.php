<?php

namespace Evocatio\Bundle\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Evocatio\Bundle\CoreBundle\Repository\LanguageRepository;

class PostTranslationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('subtitle', "text", array('required' => false))
                ->add('slug', "text", array('required' => false))
//                ->add('name', "text", array('required' => false))
                ->add('excerpt', "text", array('required' => false))
                ->add('content', "textarea", array(
                    'required' => false
                    , 'label' => false
                    , 'attr' => array('class' => 'hiden')
                ))
                ->add('title', "text", array(
                    'required' => false,
                    'attr' => array("inline-editing" => true)
                ))
                ->add('file', "file", array('required' => false, "attr" => array("multiple" => true)))
//                ->add('image', "collection", array(
//                    'type' => new MediaType(),
//                    'allow_add' => true,
//                    'property_path' => false,
//                    'prototype' => true,
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
//                ->add('pdf', "collection", array(
//                    'type' => new MediaType(),
//                    'allow_add' => true,
//                    'property_path' => false,
//                    'prototype' => true,
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
//                ->add('text', "collection", array(
//                    'type' => new MediaType(),
//                    'allow_add' => true,
//                    'property_path' => false,
//                    'prototype' => true,
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
//                ->add('other', "collection", array(
//                    'type' => new MediaType(),
//                    'allow_add' => true,
//                    'property_path' => false,
//                    'prototype' => true,
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
                ->add('trans_lang', null, array(
                    "property" => "name"
                    , "label" => false
                    , 'query_builder' => function(LanguageRepository $er) {
                        return $er->filterByStatus(\Evocatio\Bundle\CoreBundle\Entity\Language::STATUS_PUBLISHED)
                                ->orderByRank()
                                ->getQueryBuilder();
                    }
                    , "attr" => array(
                        "class" => "hidden"
                    )
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\WebBundle\Entity\PostTranslation'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_webbundle_posttranslationtype';
    }

}
