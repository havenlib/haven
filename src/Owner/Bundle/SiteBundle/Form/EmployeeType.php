<?php

namespace Owner\Bundle\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmployeeType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('firstname')
                ->add('lastname')
                ->add('sex', 'choice', array(
                    'choices' => array(
                        'm' => 'male'
                        , 'f' => 'female'
                    )
                    , 'multiple' => false
                ))
//                ->add('user', new \Haven\Bundle\SecurityBundle\Form\UserType())
                ->add('user')
                ->add('profile', new ProfileType())
                ->add('slug')
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn save-btn'),
                    'label' => 'save'
                ))
//                ->add('postal', "collection", array(
//                    'type' => new PostalType(),
//                    'allow_add' => true,
//                    'prototype' => true,
//                    // Post update
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
//                ->add('map', "collection", array(
//                    'type' => new MapType(),
//                    'allow_add' => true,
//                    'prototype' => true,
//                    // Post update
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
//                ->add('web', "collection", array(
//                    'type' => new WebType(),
//                    'allow_add' => true,
//                    'prototype' => true,
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
//                ->add('telephone', "collection", array(
//                    'type' => new TelephoneType(),
//                    'allow_add' => true,
//                    'prototype' => true,
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
//                ->add('time', "collection", array(
//                    'type' => new TimeType(),
//                    'allow_add' => true,
//                    'prototype' => true,
//                    'by_reference' => true,
//                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Owner\Bundle\SiteBundle\Entity\Employee'
        ));
    }

    public function getName() {
        return 'owner_bundle_sitebundle_employeetype';
    }

}
