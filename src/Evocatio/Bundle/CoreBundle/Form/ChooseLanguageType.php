<?php

namespace Evocatio\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Evocatio\Bundle\CoreBundle\Lib\Locale;

class ChooseLanguageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('symbol', "choice", array(
//                    "class" => "EvocatioCoreBundle:Language"
                    "choices" => Locale::getAvailableDisplaySystemLocales(Locale::getDefault())
                    , 'multiple' => true
//                    , 'property' => 'symbol'
                    , 'expanded' => true
                    ))
        ;
    }

    public function getName() {
        return 'evocatio_bundle_corebundle_chooselanguagetype';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        return array(
            'data_class' => 'Evocatio\Bundle\CoreBundle\Entity\Language',
        );
    }

}
