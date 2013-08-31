<?php

namespace Owner\Bundle\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Haven\Bundle\CoreBundle\Repository\LanguageRepository;

class ProfileTranslationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('description', 'textarea', array(
                    'required' => false
                    , 'attr' => array('class' => 'ckeditor')
                ))
                ->add('trans_lang', null, array(
                    "property" => "name"
                    , "label" => false
                    , 'query_builder' => function(LanguageRepository $er) {
                        return $er->filterByStatus(\Haven\Bundle\CoreBundle\Entity\Language::STATUS_PUBLISHED)
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
            'data_class' => 'Owner\Bundle\SiteBundle\Entity\ProfileTranslation'
        ));
    }

    public function getName() {
        return 'owner_bundle_sitebundle_profiletranslationtype';
    }

}
