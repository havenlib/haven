<?php

/*
 * This file is part of the Haven package.
 *
 * (c) Laurent Breleur <lbreleur@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Haven\Bundle\MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FileType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('fileName', 'text', array("required" => false))
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn save-btn'),
                    'label' => 'save'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Haven\Bundle\MediaBundle\Entity\File'
        ));
    }

    public function getName() {
        return 'haven_mediabundle_filetype';
    }

}
