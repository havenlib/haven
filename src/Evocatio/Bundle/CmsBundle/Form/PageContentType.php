<?php

namespace Evocatio\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageContentType extends AbstractType {

    protected $i = 0;
    protected $content_type = null;

    public function __construct($content_type) {
        $this->content_type = $content_type;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('area')
                ->add('content', new $this->content_type())
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\CmsBundle\Entity\PageContent'
        ));
    }

    public function getName() {
        return 'evocatio_bundle_cmsbundle_pagecontenttype';
    }

}
