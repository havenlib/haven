<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evocatio\Bundle\PosBundle\Entity\Products
 */
class Products
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var decimal $prix
     */
    private $prix;

    /**
     * @var boolean $Actif
     */
    private $Actif;

    /**
     * @var Evocatio\Bundle\PosBundle\Entity\ProductTranslation
     */
    private $translations;

    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set prix
     *
     * @param decimal $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * Get prix
     *
     * @return decimal 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set Actif
     *
     * @param boolean $actif
     */
    public function setActif($actif)
    {
        $this->Actif = $actif;
    }

    /**
     * Get Actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->Actif;
    }

    /**
     * Add translations
     *
     * @param Evocatio\Bundle\PosBundle\Entity\ProductTranslation $translations
     */
    public function addProductTranslation(\Evocatio\Bundle\PosBundle\Entity\ProductTranslation $translations)
    {
        $this->translations[] = $translations;
    }

    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}