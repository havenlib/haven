<?php

namespace Evocatio\Bundle\PersonaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('master')
            ->add('address')
            ->add('address2')
            ->add('code_postal')
            ->add('ville')
//            ->add('persona')
//            ->add('country')
//            ->add('state')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PersonaBundle\Entity\Postal'
        ));
    }

    public function getName()
    {
        return 'evocatio_bundle_personabundle_postaltype';
    }
}
