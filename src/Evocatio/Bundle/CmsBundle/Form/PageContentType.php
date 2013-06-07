<?php

namespace Evocatio\Bundle\CmsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageContentType extends AbstractType
{
    protected $i = 0;
    protected $test = null;
    
    public function __construct($test) {
        $this->test = $test;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $type = "Evocatio\Bundle\CmsBundle\Form\HtmlContentType";
        $builder
            ->add('area')
            ->add('html_content', new $type())
        ;
        echo "test ".$this->i++."<br />";
//        print_r($options);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Evocatio\Bundle\CmsBundle\Entity\PageContent'
        ));
    }

    public function getName()
    {
        return 'evocatio_bundle_cmsbundle_pagecontenttype';
    }
}
