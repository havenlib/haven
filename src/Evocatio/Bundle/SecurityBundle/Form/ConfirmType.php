<?php

namespace Evocatio\Bundle\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ConfirmType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('confirmation')
                ->add('plainPassword', 'repeated', array('type' => 'password'
//                    , "first_name" => "mot.de.passe"
//                    , "second_name" => "repetez.mot.de.passe"
                    , "invalid_message" => "mot.de.passe.pas.identiques"
                    , "options" => array("required" => true)))
//                ->add("uuid", "text")
        ;
    }

    public function getName() {
        return 'evocatio_bundle_securitybundle_confirmtype';
    }

}
