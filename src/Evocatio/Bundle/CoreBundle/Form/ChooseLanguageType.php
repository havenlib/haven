<?php

namespace Evocatio\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Evocatio\Bundle\CoreBundle\Lib\Locale;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChooseLanguageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('symbol', "choice", array(
//                    "class" => "EvocatioCoreBundle:Language"
                    "choices" => Locale::getAvailableDisplayLanguage(Locale::getDefault())
                    , 'multiple' => true
//                    , 'property' => 'symbol'
                    , 'expanded' => true
                ))
        ;
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
//            'data_class' => 'Evocatio\Bundle\CoreBundle\Entity\Language',
        ));
    }

    public function getName() {
        return 'evocatio_bundle_corebundle_chooselanguagetype';
    }
    
}
