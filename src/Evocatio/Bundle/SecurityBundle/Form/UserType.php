<?php

namespace Evocatio\Bundle\SecurityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('username')
                ->add('email')
                ->add('plainPassword', 'repeated', array('type' => 'password'
                    , "first_name" => "password"
                    , "second_name" => "confirmation"
                    , "invalid_message" => "mot.de.passe.pas.identiques"
                    , "required" => false
                    , 'label' => 'Password'
                ))
                ->add('status', 'choice', array(
                    'choices' => array(
                        1 => 'actif'
                        , 2 => 'inactif'
                    )
                    , 'multiple' => false
                ))
                ->add('locked', 'checkbox', array("required" => false))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\SecurityBundle\Entity\User'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_securitybundle_utilisateurtype';
    }

}
