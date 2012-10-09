<?php

namespace tahua\SiteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of LoginType
 *
 * @author themaster
 */
class RegisterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                /* ->add('title', 'entity', array(
                  'class' => 'tahua\SiteBundle\Entity\Civilite',
                  'multiple' => false, 'expanded' => true,
                  )) */
//                ->add('title', 'choice', array('choices' => array('1' => 'Mme', '2' => 'M'), 'multiple' => false, 'expanded' => true))
//                ->add('username', 'text')
//                ->add('lastname', 'text', array('required' => true))
                ->add('email', 'email', array('label' => 'mon.courriel'))
                ->add('plainPassword', 'repeated', array('type' => 'password'
//                    , "first_name" => "mot.de.passe"
//                    , "second_name" => "repetez.mot.de.passe"
                    , "invalid_message" => "mot.de.passe.pas.identiques"
                    , "options" => array("required"=>true)));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return array(
            'data_class' => 'Evocatio\Bundle\PersonaBundle\Entity\Contact'
        );
    }

    public function getName() {
        return 'register';
    }

}