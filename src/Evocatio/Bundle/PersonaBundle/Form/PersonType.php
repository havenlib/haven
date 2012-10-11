<?php

namespace Evocatio\Bundle\PersonaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('id')
            ->add('firstname')
            ->add('lastname')
            ->add('sex')
            ->add('birthday')
//            ->add('created_at')
//            ->add('created_by')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\PersonaBundle\Entity\Person'
        ));
    }

    public function getName()
    {
        return 'evocatio_bundle_personabundle_persontype';
    }
}
