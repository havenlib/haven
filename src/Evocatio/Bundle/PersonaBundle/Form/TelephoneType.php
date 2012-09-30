<?php

namespace Evocatio\Bundle\PersonaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of TelephoneType
 *
 * @author themaster
 */
class TelephoneType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('telephone', 'integer')
                ->add('type', 'text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
        return array(
            'data_class' => 'Evocatio\Bundle\PersonaBundle\Entity\Telephone'
        );
    }

    public function getName() {
        return 'telephone';
    }

}