<?php

namespace Evocatio\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FilePageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('mimeType')
                ->add('pathName')
                ->add('name')
                ->add('fileName')
                ->add('size')
//            ->add('parent')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\CmsBundle\Entity\FilePage'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_cmsbundle_filepagetype';
    }

}
