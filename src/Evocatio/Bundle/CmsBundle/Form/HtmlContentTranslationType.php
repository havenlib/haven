<?php

namespace Evocatio\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Evocatio\Bundle\CoreBundle\Repository\LanguageRepository;

class HtmlContentTranslationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('content', null, array(
                    "attr" => array(
                        "class" => "ckeditor"
                    )
                    ,"required" =>false
                ))
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
            'data_class' => 'Evocatio\Bundle\CmsBundle\Entity\HtmlContentTranslation'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_cmsbundle_htmlcontenttranslationtype';
    }

}
