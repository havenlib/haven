<?php
namespace Owner\Bundle\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;

class ContactType extends AbstractType{
    
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
    }
    
    public function getName() {
     return "owner_bundle_sitebundle_contacttype";   
    }
}

?>
