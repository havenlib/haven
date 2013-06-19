<?php

namespace Evocatio\Bundle\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class FaqCollectionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('faqs', 'collection', array(
                    'type' => new FaqRankType()
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
        return 'evocatio_bundle_webbundle_faqcollectiontype';
    }

}
