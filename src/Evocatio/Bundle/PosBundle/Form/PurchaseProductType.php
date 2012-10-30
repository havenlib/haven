<?php

namespace Evocatio\Bundle\PosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PurchaseProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add('price')
            ->add('purchase')
            ->add('product')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PosBundle\Entity\PurchaseProduct'
        ));
    }

    public function getName()
    {
        return 'evocatio_bundle_posbundle_purchaseproducttype';
    }
}
