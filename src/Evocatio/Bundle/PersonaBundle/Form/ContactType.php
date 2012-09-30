<?php

namespace Evocatio\Bundle\PersonaBundle\Form;

// Symfony includes
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ContactType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('id', 'hidden')
                ->add("firstname", 'text')
                ->add("lastname", 'text')
                ->add("contact_address", "collection", array('type' => new \Evocatio\Bundle\PersonaBundle\Form\ContactAddressType()))
                ->add('telephone', "text", array('required' => false))
                ->add('civilite', 'choice', array('choices' => array('1' => 'Mme', '2' => 'M'), 'multiple' => false, 'expanded' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
        return array("data_class" => "Evocatio\Bundle\PersonaBundle\Entity\Contact");
    }

    public function getName() {
        return "Contact";
    }

}

?>
