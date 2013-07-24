<?php

namespace Evocatio\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
 use Evocatio\Bundle\CoreBundle\Repository\LanguageRepository;

class MenuTranslationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('link')
                ->add('name')
                ->add('trans_lang', null, array(
                    "property" => "name"
                    , "label" => false
                    , 'query_builder' => function(LanguageRepository $er) {
                        return $er->filterByStatus(\Evocatio\Bundle\CoreBundle\Entity\Language::STATUS_PUBLISHED)
                                ->orderByRank()
                                ->getQueryBuilder();
                    }
                    , "empty_value" => false
                    , "attr" => array(
                        "class" => "hidden"
                    )
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\CmsBundle\Entity\MenuTranslation'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_cmsbundle_menutranslationtype';
    }

}
