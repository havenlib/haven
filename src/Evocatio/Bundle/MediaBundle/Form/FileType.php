<?php

namespace Evocatio\Bundle\MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FaqType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('mimeType')
                ->add('pathName')
                ->add('name')
                ->add('fileName')
                ->add('size', 'text')
//            ->add('parent')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\MediaBundle\Entity\FileCriminal'
        ));
    }

    public function getName() {
        return 'website_bundle_sitebundle_filecriminaltype';
    }

}
