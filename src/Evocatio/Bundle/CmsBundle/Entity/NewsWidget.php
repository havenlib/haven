<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsWidget
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class NewsWidget extends Widget {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="NewsWidgetTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    public function getName($lang = null) {
        return $this->getTranslated('Name', $lang);
    }

    public function getContent($lang = null) {
        return $this->getTranslated('Content', $lang);
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
     * Constructor
     */
    public function __construct() {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add translations
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\NewsWidgetTranslation $translations
     * @return NewsWidget
     */
    public function addTranslation(\Evocatio\Bundle\CmsBundle\Entity\NewsWidgetTranslation $translations) {
        $translations->setParent($this);
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\NewsWidgetTranslation $translations
     */
    public function removeTranslation(\Evocatio\Bundle\CmsBundle\Entity\NewsWidgetTranslation $translations) {
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
    
    public function getBundle() {
        return null;
    }
    
    public function getController() {
        return "Post";
    }
    
    public function getAction() {
        return "listWidget";
    }

}