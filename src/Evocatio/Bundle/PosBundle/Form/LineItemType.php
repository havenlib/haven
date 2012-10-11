<?php

namespace Evocatio\Bundle\PosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LineItemType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('product', 'entity', array(
                    'class' => 'EvocatioPosBundle:Product',
                    'property' => 'name'))
                ->add('quantity');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PosBundle\Entity\LineItem',
        ));
    }

    public function getName() {
        return 'evocatio_bundle_posbundle_baskettype';
    }

}
