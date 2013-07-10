<?php

namespace Evocatio\Bundle\PortfolioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FoglioType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('translations', 'translation', array(
                    'type' => new FoglioTranslationType()
                    , 'allow_add' => true
                    , "label" => false
                    , 'prototype' => true
                    , 'prototype_name' => '__name_trans__'
                    , 'by_reference' => false
                    , 'options' => array(
                        'label' => false
                    )
                ))
                ->add('createdAt')
                ->add('updatedAt')
                ->add('status')
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn save-btn'),
                    'label' => 'save.faq'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PortfolioBundle\Entity\Foglio'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_portfoliobundle_fogliotype';
    }

}
