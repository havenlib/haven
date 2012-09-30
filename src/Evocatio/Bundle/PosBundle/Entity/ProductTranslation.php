<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\PosBundle\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;
use Evocatio\Bundle\PosBundle\Entity\ProductTranslationMappedBase;

/**
 * Evocatio\Bundle\PosBundle\Entity\ProductTranslation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PosBundle\Entity\ProductTranslationRepository")
 */
class ProductTranslation extends ProductTranslationMappedBase
{
    
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * @var text $caracteristique
     *
     * @ORM\Column(name="caracteristique", type="text", nullable=true)
     */
    protected $caracteristique;

    /**
     * @var text $Introduction
     *
     * @ORM\Column(name="Introduction", type="text", nullable=true)
     */
    protected $Introduction;
    
    /**
     * @var text $Avertissement
     * @ORM\Column(name="Avertissement", type="text", nullable=true)
     */
    protected $Avertissement;

    /**
     * @var text $contre_indications
     * @ORM\Column(name="contre_indications", type="text", nullable=true)
     */
    private $contre_indications;

    /**
     * @var text $mise_en_garde
     * @ORM\Column(name="mise_en_garde", type="text", nullable=true)
     */
    private $mise_en_garde;
    /**
     * @var text $ingredients
     * @ORM\Column(name="ingredients", type="text", nullable=true)
     */
    protected $ingredients;
    



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set caracteristique
     *
     * @param text $caracteristique
     */
    public function setCaracteristique($caracteristique)
    {
        $this->caracteristique = $caracteristique;
    }

    /**
     * Get caracteristique
     *
     * @return text 
     */
    public function getCaracteristique()
    {
        return $this->caracteristique;
    }

    /**
     * Set Introduction
     *
     * @param text $introduction
     */
    public function setIntroduction($introduction)
    {
        $this->Introduction = $introduction;
    }

    /**
     * Get Introduction
     *
     * @return text 
     */
    public function getIntroduction()
    {
        return $this->Introduction;
    }

    /**
     * Set Avertissement
     *
     * @param text $avertissement
     */
    public function setAvertissement($avertissement)
    {
        $this->Avertissement = $avertissement;
    }

    /**
     * Get Avertissement
     *
     * @return text 
     */
    public function getAvertissement()
    {
        return $this->Avertissement;
    }

    /**
     * Set contre_indications
     *
     * @param text $contreIndications
     */
    public function setContreIndications($contreIndications)
    {
        $this->contre_indications = $contreIndications;
    }

    /**
     * Get contre_indications
     *
     * @return text 
     */
    public function getContreIndications()
    {
        return $this->contre_indications;
    }

    /**
     * Set mise_en_garde
     *
     * @param text $miseEnGarde
     */
    public function setMiseEnGarde($miseEnGarde)
    {
        $this->mise_en_garde = $miseEnGarde;
    }

    /**
     * Get mise_en_garde
     *
     * @return text 
     */
    public function getMiseEnGarde()
    {
        return $this->mise_en_garde;
    }

    /**
     * Set ingredients
     *
     * @param text $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    /**
     * Get ingredients
     *
     * @return text 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }
}