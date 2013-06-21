<?php
namespace Owner\Bundle\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;

class ContactType extends AbstractType{
    
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        
        $builder
                ->add('firstname')
                ->add('lastname')
                ->add('email')
                ->add('organisation')
                ->add('phone')
                ->add('reference')
                ->add('message', 'textarea')
                ;
    }
    
    public function getName() {
     return "owner_bundle_sitebundle_contacttype";   
    }
}

?>
