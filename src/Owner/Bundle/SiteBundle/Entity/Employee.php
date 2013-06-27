<?php

namespace Owner\Bundle\SiteBundle\Entity;

use Evocatio\Bundle\PersonaBundle\Entity\Persona;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Employee extends Persona {

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=128, unique=false)
     */
    private $firstname;

    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=128, unique=false)
     */
    private $lastname;

    /**
     * @var string $sex
     *
     * @ORM\Column(name="sex", type="integer")
     */
    private $sex;

    /**
     * @ORM\OneToOne(targetEntity="Evocatio\Bundle\SecurityBundle\Entity\User", mappedBy="persona",cascade={"all"})
     */
    private $user;

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Employee
     */
    public function setFirstname($firstname) {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Employee
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set sex
     *
     * @param integer $sex
     * @return Employee
     */
    public function setSex($sex) {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return integer 
     */
    public function getSex() {
        return $this->sex;
    }


    /**
     * Set user
     *
     * @param \Evocatio\Bundle\SecurityBundle\Entity\User $user
     * @return Employee
     */
    public function setUser(\Evocatio\Bundle\SecurityBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Evocatio\Bundle\SecurityBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}