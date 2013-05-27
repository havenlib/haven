<?php

namespace Evocatio\Bundle\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Evocatio\Bundle\CoreBundle\Repository\LanguageRepository;

class FaqTranslationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('question', "textarea", array("required" => false))
                ->add('reponse', "textarea", array("required" => false))
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
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\WebBundle\Entity\FaqTranslation'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_webbundle_faqtranslationtype';
    }

}
