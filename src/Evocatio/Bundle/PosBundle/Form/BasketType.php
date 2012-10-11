<?php
namespace Evocatio\Bundle\PosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class BasketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('line_items', "collection", array(
                    "type" => new LineItemType(),
                    'allow_add' => true,
                    'prototype' => true,
                    // Post update
                    'by_reference' => true))
            ->add('devise');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Evocatio\Bundle\PosBundle\Entity\Basket',
        ));
    }
    
    public function getName()
    {
        return 'evocatio_bundle_posbundle_baskettype';
    }    
}
