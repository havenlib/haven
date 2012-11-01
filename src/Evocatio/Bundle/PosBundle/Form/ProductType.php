<?php
namespace Evocatio\Bundle\PosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        

        $builder
//	    ->add('category', 'entity', array(
//                    'class' => 'tahua\SiteBundle\Entity\Category',
//                    'multiple' => false, 'expanded' => false,'property' => 'nom',
//                ))
//            ->add('Titre', 'text', array('required' => true))
//            ->add('Name', 'text', array('required' => true))
//            ->add('translations', 'collection', array('type' => new ProductTranslationType()))
            ->add('price')
//            ->add('Poids')
//            ->add('Kasher', 'checkbox', array('required'=>false, 'attr' => array('class' => 'inline checkbox')))
//            ->add('quantite')		
//            ->add('unite')
//             ->add('complements', null, array("required" => false))	
;
    }
    
    public function getDefaultOptions(array $options)
    {
            return array(
                'data_class' => 'Evocatio\Bundle\PosBundle\Entity\Product',
//                'translation_class' => 'Evocatio\Bundle\PosBundle\Entity\ProductTranslation'
            );
    }
    
    public function getOption($name){
        $options = $this->getDefaultOptions(array());
        return $options[$name];
    }
    
    public function getName()
    {
        return 'produit';
    }    
}
