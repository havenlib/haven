<?php

namespace Website\Bundle\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LibraryModuleTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Website\Bundle\SiteBundle\Entity\LibraryModuleTranslation'
        ));
    }

    public function getName()
    {
        return 'website_bundle_sitebundle_librarymoduletranslationtype';
    }
}
