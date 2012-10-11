<?php

namespace Evocatio\Bundle\PosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class BasketProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('quantity')
                ->add('product', 'entity', array(
                    'class' => 'EvocatioPosBundle:Product',
                    'property' => 'name',
                    'required' => true,
//                    it is not possible to sort easily here cuz the info is multi langual and not the same for each type product,
//                    It should be sorted at display time, or maybe in event (data set ?)
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                                ->where('p.status = true');
                    }
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PosBundle\Entity\OrderProduct'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_posbundle_orderproducttype';
    }

}
