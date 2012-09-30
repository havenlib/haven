<?php

namespace Evocatio\Bundle\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//                ->add('username')
                ->add('email')
                ->add('plainPassword', 'repeated', array('type' => 'password'
//                    , "first_name" => "mot.de.passe"
//                    , "second_name" => "repetez.mot.de.passe"
                    , "invalid_message" => "mot.de.passe.pas.identiques"
                    , "options" => array("required" => true)))
//            ->add('salt')
//                ->add('locked')
//            ->add('status')
//            ->add('created_at')
//            ->add('created_by')
//            ->add('contact')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
        return array(
            'data_class' => 'Evocatio\Bundle\SecurityBundle\Entity\User',
        );
    }

    public function getName() {
        return 'evocatio_bundle_securitybundle_utilisateurtype';
    }

}
