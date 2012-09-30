<?php

namespace Evocatio\Bundle\PersonaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Evocatio\Bundle\PersonaBundle\Entity\Address
 *
 * @ORM\Entity
 */
class Postal extends Coordinate {

    /**
     * @Assert\NotBlank
     * @ORM\Column(name="address", type="string", length=255)
     */
    protected $address;
    
    /**
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     */
    protected $address2;

    /**
     * @var string $ville
     * @Assert\NotBlank
     * @ORM\Column(name="ville", type="string", length=255)
     */
    protected $ville;
    

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address2
     *
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set ville
     *
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }
}