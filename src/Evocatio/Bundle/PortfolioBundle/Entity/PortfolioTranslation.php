<?php

namespace Evocatio\Bundle\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Entity\SluggableMappedBase;

/**
 * Evocatio\Bundle\PortfolioBundle\Entity\PortfolioTranslation
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class PortfolioTranslation extends SluggableMappedBase {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * @ORM\ManyToOne(targetEntity="Portfolio", inversedBy="translations")
     * @ORM\JoinColumn(name="portfolio_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * Set name
     *
     * @param string $name
     * @return PortfolioTranslation
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PortfolioTranslation
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set parent
     *
     * @param \Evocatio\Bundle\PortfolioBundle\Entity\Portfolio $parent
     * @return PortfolioTranslation
     */
    public function setParent(\Evocatio\Bundle\PortfolioBundle\Entity\Portfolio $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Evocatio\Bundle\PortfolioBundle\Entity\Portfolio 
     */
    public function getParent() {
        return $this->parent;
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
}