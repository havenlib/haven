<?php

namespace Evocatio\Bundle\PostBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('status', 'choice', array(
                    'choices' => array(0 => "Inactive", 1 => "Publish", 2 => "Draft")
                ))
                ->add('postbegin_at', "date", array('required' => false))
                ->add('postend_at', "date", array('required' => false))
                ->add('translations', 'collection', array('type'=> new PostTranslationType()))

        ;
    }

    public function getName() {
        return 'evocatio_bundle_postbundle_posttype';
    }

}
