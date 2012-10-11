<?php

namespace Evocatio\Bundle\PosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenericProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('price')
                ->add('status')
                ->add('translations', 'collection', array('type' => new GenericProductTranslationType()))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PosBundle\Entity\GenericProduct'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_posbundle_genericproducttype';
    }

}
