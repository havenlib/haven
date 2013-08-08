<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Laurent Breleur <lbreleur@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\MediaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UploadType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('files', 'collection', array(
                    "type" => new UploadedFileType()
                    , 'allow_delete' => true
                    , 'allow_add' => true
                    , 'by_reference' => false
                ))
                ->add('uploads', 'file', array(
                    "attr" => array(
                        "multiple" => "multiple",
                    )
                    , "mapped" => false
                ))
                ->add('save', 'submit', array(
                    'attr' => array('class' => 'btn save-btn'),
                    'label' => 'upload.files'
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array());
    }

    public function getName() {
        return 'evocatio_mediabundle_uploadtype';
    }

}
