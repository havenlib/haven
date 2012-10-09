<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evocatio\Bundle\PosBundle\Entity\Products
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="plane", type="string")
 * @ORM\DiscriminatorMap({"generic"="GenericProduct"})
 */
class Product
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var decimal $prix
     */
    private $prix;

    /**
     * @var boolean $Actif
     */
    private $Actif;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}