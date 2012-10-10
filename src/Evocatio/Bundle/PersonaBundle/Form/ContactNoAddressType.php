<?php

namespace Evocatio\Bundle\PersonaBundle\Form;

// Symfony includes
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ContactNoAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'choice', array('choices' => array('1' => 'Mme', '2' => 'M'), 'multiple' => false, 'expanded' => true))
            ->add('firstname')
            ->add('lastname')
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return array("data_class" => "Evocatio\Bundle\PersonaBundle\Entity\Contact");
    }
    
    public function getName()
    {
        return 'evocatio_bundle_contactbundle_contactnoaddresstype';
    }
}
