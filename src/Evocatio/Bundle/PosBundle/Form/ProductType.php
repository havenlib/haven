<?php

namespace Evocatio\Bundle\PosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('price')
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn save-btn'),
                    'label' => 'save.product'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PosBundle\Entity\Product'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_posBundle_producttype';
    }

}
