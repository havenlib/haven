<?php

namespace Owner\Bundle\SiteBundle\Entity;

use Evocatio\Bundle\CoreBundle\Generic\Translatable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class Profile extends Translatable {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="ProfileTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    /**
     * @ORM\OneToOne(targetEntity="Employee", cascade="all")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $employee;

    /**
     * Constructor
     */
    public function __construct() {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add translations
     *
     * @param \Owner\Bundle\SiteBundle\Entity\ProfileTranslation $translations
     * @return Profile
     */
    public function addTranslation(\Owner\Bundle\SiteBundle\Entity\ProfileTranslation $translations) {
        $translations->setParent($this);
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Owner\Bundle\SiteBundle\Entity\ProfileTranslation $translations
     */
    public function removeTranslation(\Owner\Bundle\SiteBundle\Entity\ProfileTranslation $translations) {
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
     * Set persona
     *
     * @param \Owner\Bundle\SiteBundle\Entity\Employee $persona
     * @return Profile
     */
    public function setPersona(\Owner\Bundle\SiteBundle\Entity\Employee $persona = null) {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \Owner\Bundle\SiteBundle\Entity\Employee 
     */
    public function getPersona() {
        return $this->persona;
    }

    /**
     * Set employee
     *
     * @param \Owner\Bundle\SiteBundle\Entity\Employee $employee
     * @return Profile
     */
    public function setEmployee(\Owner\Bundle\SiteBundle\Entity\Employee $employee = null) {
        $this->employee = $employee;

        return $this;
    }

    /**
     * Get employee
     *
     * @return \Owner\Bundle\SiteBundle\Entity\Employee 
     */
    public function getEmployee() {
        return $this->employee;
    }

}