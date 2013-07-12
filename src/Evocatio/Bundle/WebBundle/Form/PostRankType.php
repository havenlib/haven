<?php

namespace Evocatio\Bundle\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class PostRankType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('rank', 'text')
                ->add('submit', 'submit', array(
                    'attr' => array('class' => 'btn pull-right ajax')
                    , 'label' => 'rank'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\WebBundle\Entity\Post'
        ));
    }

    public function getName() {
        return 'ranktype';
    }

}
