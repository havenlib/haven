<?php

namespace Website\Bundle\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('librarymodule', "collection", array(
                    'type' => new \Website\Bundle\SiteBundle\Form\LibraryModuleType(),
                    'allow_add' => true,
                    'prototype' => true,
                    'by_reference' => true,
                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
            ->add('genericproduct', "collection", array(
                    'type' => new \Evocatio\Bundle\PosBundle\Form\GenericProductType(),
                    'allow_add' => true,
                    'prototype' => true,
                    'by_reference' => true,
                    "attr" => array("class" => "coordinate", "data-join-class" => "coordinate")))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
//            'data_class' => 'Evocatio\Bundle\PersonaBundle\Entity\Person'
        ));
    }

    public function getName()
    {
        return 'website_bundle_sitebundle_addproducttype';
    }
}
