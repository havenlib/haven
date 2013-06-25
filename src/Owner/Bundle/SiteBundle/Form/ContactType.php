<?php

namespace Owner\Bundle\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;

class ContactType extends AbstractType {

    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {

        $builder
                ->add('firstname', 'text', array(
                    'required' => false
                ))
                ->add('lastname', 'text', array(
                    'required' => false
                ))
                ->add('email', 'text', array(
                    'required' => true
                ))
                ->add('organisation', 'text', array(
                    'required' => false
                ))
                ->add('phone', 'text', array(
                    'required' => false
                ))
                ->add('reference', 'text', array(
                    'required' => false
                ))
                ->add('message', 'textarea')
        ;
    }

    public function getName() {
        return "owner_bundle_sitebundle_contacttype";
    }

}

?>
