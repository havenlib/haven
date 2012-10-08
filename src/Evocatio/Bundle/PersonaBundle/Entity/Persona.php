<?php

namespace Evocatio\Bundle\PersonaBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Evocatio\Bundle\PersonaBundle\Entity\ContactAddress;

/**
 * Evocatio\Bundle\PersonaBundle\Entity\Persona
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({"persona" = "Persona","person" = "Person", "company" = "Company"})
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PersonaBundle\Entity\PersonaRepository")
 */
class Persona {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var integer $created_by
     *
     * @ORM\Column(name="created_by", type="integer")
     */
    private $created_by;

    public function __construct() {
        $this->setCreatedAt(new \DateTime());
        $this->setCreatedBy("1");
    }

//    /**
//     * @ORM\OneToMany(targetEntity="ContactAddress", mappedBy="contact", cascade={"persist"})
//     */
//    protected $contact_address;
     /**
     * @ORM\ManyToMany(targetEntity="Persona", mappedBy="coordinate")
     * @ORM\JoinTable(name="person_coordinate")
     */
    private $coordinate;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Persona
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set created_by
     *
     * @param integer $createdBy
     * @return Persona
     */
    public function setCreatedBy($createdBy)
    {
        $this->created_by = $createdBy;
    
        return $this;
    }

    /**
     * Get created_by
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Add coordinate
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Coordinate $coordinate
     * @return Persona
     */
    public function addCoordinate(\Evocatio\Bundle\PersonaBundle\Entity\Coordinate $coordinate)
    {
        $this->coordinate[] = $coordinate;
    
        return $this;
    }

    /**
     * Remove coordinate
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Coordinate $coordinate
     */
    public function removeCoordinate(\Evocatio\Bundle\PersonaBundle\Entity\Coordinate $coordinate)
    {
        $this->coordinate->removeElement($coordinate);
    }

    /**
     * Get coordinate
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }
}