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

class UploadedFileType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('mimeType', 'text', array("required" => false))
                ->add('pathName', 'text', array("required" => false))
                ->add('name', 'text', array("required" => false))
                ->add('fileName', 'text', array("required" => false))
                ->add('size', 'text', array("required" => false))
//                ->add('upload', 'file', array(
//                    "mapped" => false
//                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\MediaBundle\Entity\File'
        ));
    }

    public function getName() {
        return 'evocatio_mediabundle_uploadedfiletype';
    }

}
