<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Widget
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Widget extends Content {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     */
    protected $status;

    /**
     * @var \Evocatio\Bundle\CmsBundle\Entity\Page
     */
    protected $page;

    /**
     * @ORM\OneToMany(targetEntity="WidgetTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    /**
     * @var string
     *
     * @ORM\Column(name="bundle", type="string", nullable=true)
     */
    private $bundle;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", nullable=false)
     */
    private $controller;

    /**
     * @var string
     *
     * @ORM\Column(name="action", type="string", nullable=false)
     */
    private $action;

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

    public function getName($lang = null) {
        return $this->getTranslated('Name', $lang);
    }

    public function getContent($lang = null) {
        return $this->getTranslated('Content', $lang);
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Widget
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
     * Add translations
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\WidgetTranslation $translations
     * @return Widget
     */
    public function addTranslation(\Evocatio\Bundle\CmsBundle\Entity\WidgetTranslation $translations) {
        $translations->setParent($this);
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\WidgetTranslation $translations
     */
    public function removeTranslation(\Evocatio\Bundle\CmsBundle\Entity\WidgetTranslation $translations) {
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
     * Set page
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Page $page
     * @return Widget
     */
    public function setPage(\Evocatio\Bundle\CmsBundle\Entity\Page $page = null) {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Evocatio\Bundle\CmsBundle\Entity\Page 
     */
    public function getPage() {
        return $this->page;
    }

    public function __toString() {
        return "-->" . $this->getId();
    }


    /**
     * Set bundle
     *
     * @param string $bundle
     * @return Widget
     */
    public function setBundle($bundle)
    {
        $this->bundle = $bundle;
    
        return $this;
    }

    /**
     * Get bundle
     *
     * @return string 
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    /**
     * Set controller
     *
     * @param string $controller
     * @return Widget
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    
        return $this;
    }

    /**
     * Get controller
     *
     * @return string 
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return Widget
     */
    public function setAction($action)
    {
        $this->action = $action;
    
        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }
}