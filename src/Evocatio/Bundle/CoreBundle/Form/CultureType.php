<?php

namespace Evocatio\Bundle\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CultureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('symbol')
            ->add('status')
            ->add('language', 'entity', array(
                'class' => 'Evocatio\Bundle\CoreBundle\Entity\Language',
                'property' => 'id'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\CoreBundle\Entity\Culture'
        ));
    }

    public function getName()
    {
        return 'evocatio_bundle_corebundle_culturetype';
    }
}
