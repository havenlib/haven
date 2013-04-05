<?php

namespace Evocatio\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class FaqType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('status', 'choice', array(
                    'choices' => array(
                        0 => "Inactive", 1 => "Publish"
                        )))
                ->add('translations', 'collection', array('type' => new FaqTranslationType()))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver){
        return array(
            'data_class' => "Evocatio\Bundle\FaqBundle\Entity\Faq"
        );
    }

    public function getName() {
        return 'evocatio_bundle_faqbundle_faqtype';
    }

}
