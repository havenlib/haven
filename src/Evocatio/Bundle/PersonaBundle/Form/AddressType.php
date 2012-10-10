<?php
namespace Evocatio\Bundle\PersonaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressType extends AbstractType {
    
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//            ->add('id', 'hidden')
            ->add("country", 'entity', array(
                'class' => 'EvocatioPersonaBundle:Country',
                ))
            ->add("code_postal", 'text')
            ->add("ville", 'text')
            ->add("address", 'text')
            ->add("address2", 'text', array('required' => false))
            ->add("state", 'entity', array(
                'class' => 'EvocatioPersonaBundle:State'
            ))
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver){
        return array("data_class" => "Evocatio\Bundle\PersonaBundle\Entity\Address");
    }
    
    public function getName() {
        return "evocatio_bundle_personabundle_addresstype";
    }
}

?>
