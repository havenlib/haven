<?php

namespace Evocatio\Bundle\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Evocatio\Bundle\CoreBundle\Repository\LanguageRepository;

class PortfolioTranslationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('slug')
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
            'data_class' => 'Evocatio\Bundle\PortfolioBundle\Entity\PortfolioTranslation'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_portfoliobundle_fogliotranslationtype';
    }

}
