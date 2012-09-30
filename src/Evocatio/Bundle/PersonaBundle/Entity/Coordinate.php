<?php

namespace Evocatio\Bundle\PersonaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Evocatio\Bundle\PersonaBundle\Entity\Coordinate
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="plane", type="string")
 * @ORM\DiscriminatorMap({"telephone" = "Telephone", "web" = "Web",  "map" = "Map", "time" = "Time", "postal" = "Postal"})
 */
abstract class Coordinate {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var master
     * 
     * @ORM\Column(name="master", type="string", length=256)
     */
    private $master;

    /**
     * @ORM\ManyToMany(targetEntity="Contact", mappedBy="coordinate", cascade={"persist"})
     */
    private $contact;


    public function getPlane() {
        return get_called_class();
    }
    public function __construct()
    {
        $this->contact = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set master
     *
     * @param string $master
     */
    public function setMaster($master)
    {
        $this->master = $master;
    }

    /**
     * Get master
     *
     * @return string 
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * Add contact
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Contact $contact
     */
    public function addContact(\Evocatio\Bundle\PersonaBundle\Entity\Contact $contact)
    {
        $this->contact[] = $contact;
    }

    /**
     * Get contact
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getContact()
    {
        return $this->contact;
    }
}