<?php

namespace Evocatio\Bundle\PosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('last_update')
            ->add('status')
            ->add('memo')
            ->add('delivery_name')
            ->add('delivery_address1')
            ->add('delivery_address2')
            ->add('delivery_telephone')
            ->add('delivery_city')
            ->add('delivery_postal_code')
            ->add('delivery_state')
            ->add('delivery_country')
            ->add('invoicing_name')
            ->add('invoicing_address1')
            ->add('invoicing_address2')
            ->add('invoicing_telephone')
            ->add('invoicing_city')
            ->add('invoicing_postal_code')
            ->add('invoicing_state')
            ->add('invoicing_country')
            ->add('order_total_raw')
            ->add('order_total_tax')
            ->add('order_total_charges')
            ->add('delivery_charge')
            ->add('order_currency')
            ->add('confirmation')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PosBundle\Entity\Order'
        ));
    }

    public function getName()
    {
        return 'evocatio_bundle_posbundle_ordertype';
    }
}
