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
     * @ORM\Column(name="sex", type="string", columnDefinition="ENUM('m', 'f')")
     */
    private $sex;

    /**
     * @ORM\OneToOne(targetEntity="Evocatio\Bundle\SecurityBundle\Entity\User", mappedBy="persona",cascade={"all"})
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="employee", cascade={"all"})
     */
    private $profile;

    /**
     * @var string $slug
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

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
    public function setUser(\Evocatio\Bundle\SecurityBundle\Entity\User $user = null) {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Evocatio\Bundle\SecurityBundle\Entity\User 
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();

        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add translations
     *
     * @param \Owner\Bundle\SiteBundle\Entity\EmployeeTranslation $translations
     * @return Employee
     */
    public function addTranslation(\Owner\Bundle\SiteBundle\Entity\EmployeeTranslation $translations) {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Owner\Bundle\SiteBundle\Entity\EmployeeTranslation $translations
     */
    public function removeTranslation(\Owner\Bundle\SiteBundle\Entity\EmployeeTranslation $translations) {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTranslations() {
        return $this->translations;
    }

    /**
     * Set profile
     *
     * @param \Owner\Bundle\SiteBundle\Entity\Profile $profile
     * @return Employee
     */
    public function setProfile(\Owner\Bundle\SiteBundle\Entity\Profile $profile = null) {
        $profile->setEmployee($this);
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Owner\Bundle\SiteBundle\Entity\Profile 
     */
    public function getProfile() {
        return $this->profile;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Employee
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug() {
        return $this->slug;
    }

    public function getFullname() {
        return $this->getFirstname() . " " . $this->getLastname();
    }

}