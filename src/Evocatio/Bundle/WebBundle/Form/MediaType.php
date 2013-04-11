<?php

namespace Evocatio\Bundle\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class MediaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text')
                ->add('size', 'text')
                ->add('path', 'text')
        ;
    }

    public function getName() {
        return 'evocatio_bundle_webbundle_mediatype';
    }

}
