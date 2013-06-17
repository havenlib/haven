<?php

namespace Evocatio\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Evocatio\Bundle\CoreBundle\Entity\TranslationMappedBase;

/**
 * Evocatio\Bundle\WebBundle\Entity\CategoryTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CategoryTranslation extends TranslationMappedBase {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var text $name
     * 
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="CategoryTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="translations")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return CategoryTranslation
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
     * Set parent
     *
     * @param \Evocatio\Bundle\WebBundle\Entity\Category $parent
     * @return CategoryTranslation
     */
    public function setParent(\Evocatio\Bundle\WebBundle\Entity\Category $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Evocatio\Bundle\WebBundle\Entity\Category 
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add translations
     *
     * @param \Evocatio\Bundle\WebBundle\Entity\CategoryTranslation $translations
     * @return CategoryTranslation
     */
    public function addTranslation(\Evocatio\Bundle\WebBundle\Entity\CategoryTranslation $translations)
    {
        $this->translations[] = $translations;
    
        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Evocatio\Bundle\WebBundle\Entity\CategoryTranslation $translations
     */
    public function removeTranslation(\Evocatio\Bundle\WebBundle\Entity\CategoryTranslation $translations)
    {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTranslations()
    {
        return $this->translations;
    }
}