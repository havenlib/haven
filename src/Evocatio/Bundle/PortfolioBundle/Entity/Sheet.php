<?php

namespace Evocatio\Bundle\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sheet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PortfolioBundle\Repository\SheetRepository")
 */
class Sheet extends Translatable {

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
     * @ORM\OneToMany(targetEntity="SheetTranslation", mappedBy="parent", cascade={"persist"})
     * @Assert\Valid
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="Portfolio", inversedBy="sheets")
     * @ORM\JoinColumn(name="portfolio_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $portfolio;

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
     * @return Sheet
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
     * @return Sheet
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
     * @param SheetTranslation $translations
     * @return Sheet
     */
    public function addTranslation(SheetTranslation $translations) {
        $translations->setParent($this);
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param SheetTranslation $translations
     */
    public function removeTranslation(SheetTranslation $translations) {
        $this->translations->removeElement($translations);
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Sheet
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
     * Set portfolio
     *
     * @param \Evocatio\Bundle\PortfolioBundle\Entity\Portfolio $portfolio
     * @return Sheet
     */
    public function setPortfolio(\Evocatio\Bundle\PortfolioBundle\Entity\Portfolio $portfolio = null)
    {
        $this->portfolio = $portfolio;
    
        return $this;
    }

    /**
     * Get portfolio
     *
     * @return \Evocatio\Bundle\PortfolioBundle\Entity\Portfolio 
     */
    public function getPortfolio()
    {
        return $this->portfolio;
    }
}