<?php

namespace Evocatio\Bundle\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Portfolio
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PortfolioBundle\Repository\PortfolioRepository")
 */
class Portfolio extends Translatable {

    const STATUS_INACTIVE = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status;

    /**
     * 
     * @ORM\OneToMany(targetEntity="PortfolioTranslation", mappedBy="parent", cascade={"persist"})
     * @Assert\Valid
     */
    protected $translations;

    /**
     * 
     * @ORM\OneToMany(targetEntity="Sheet", mappedBy="portfolio", cascade={"persist"})
     * @Assert\Valid
     */
    protected $sheets;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Portfolio
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Portfolio
     */
    public function setUpdatedAt($updatedAt) {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt() {
        return $this->updatedAt;
    }

    public function getDescription($lang = null) {
        return $this->getTranslated('description', $lang);
    }

    public function getName($lang = null) {
        return $this->getTranslated('name', $lang);
    }

    /**
     * Add translations
     *
     * @param PortfolioTranslation $translations
     * @return Portfolio
     */
    public function addTranslation(PortfolioTranslation $translations) {
        $translations->setParent($this);
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param PortfolioTranslation $translations
     */
    public function removeTranslation(PortfolioTranslation $translations) {
        $this->translations->removeElement($translations);
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Portfolio
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus() {
        return $this->status;
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
     * @ORM\PrePersist
     */
    public function prePersist() {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate() {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Add sheets
     *
     * @param \Evocatio\Bundle\PortfolioBundle\Entity\Sheet $sheets
     * @return Portfolio
     */
    public function addSheet(\Evocatio\Bundle\PortfolioBundle\Entity\Sheet $sheet) {
        $sheet->setPortfolio($this);
        $this->sheets[] = $sheet;

        return $this;
    }

    /**
     * Remove sheets
     *
     * @param \Evocatio\Bundle\PortfolioBundle\Entity\Sheet $sheets
     */
    public function removeSheet(\Evocatio\Bundle\PortfolioBundle\Entity\Sheet $sheets) {
        $this->sheets->removeElement($sheets);
    }

    /**
     * Get sheets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSheets() {
        return $this->sheets;
    }

}