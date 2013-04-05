<?php

namespace Evocatio\Bundle\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FaqType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('status', 'choice', array(
                    'choices' => array(0 => "Inactive", 1 => "Publish")
                ))
                ->add('translations', 'collection', array('type' => new FaqTranslationType()))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\WebBundle\Entity\Faq'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_webbundle_faqtype';
    }

}
