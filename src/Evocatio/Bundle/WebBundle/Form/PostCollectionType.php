<?php

namespace Evocatio\Bundle\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class PostCollectionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('posts', 'collection', array(
                    'type' => new PostRankType()
                ))
                ->add('submit', 'submit', array(
                    'attr' => array('class' => 'btn pull-right ajax')
                    , 'label' => 'rank'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
        ));
    }

    public function getName() {
        return 'evocatio_bundle_webbundle_postcollectiontype';
    }

}
