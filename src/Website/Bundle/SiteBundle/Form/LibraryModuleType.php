<?php

namespace Website\Bundle\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LibraryModuleType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('price')
                ->add('status')
                ->add('translations', 'collection', array('type' => new LibraryModuleTranslationType()))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PosBundle\Entity\Product'
        ));
    }

    public function getName() {
        return 'website_bundle_sitebundle_librarymoduletype';
    }

}
