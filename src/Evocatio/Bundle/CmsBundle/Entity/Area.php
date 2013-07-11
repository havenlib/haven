<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Area {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Template", inversedBy="areas")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     */
    private $template;

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
     * @return Area
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
     * Set page
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Page $page
     * @return Area
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

    /**
     * Set template
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Template $template
     * @return Area
     */
    public function setTemplate(\Evocatio\Bundle\CmsBundle\Entity\Template $template = null) {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return \Evocatio\Bundle\CmsBundle\Entity\Template 
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->contents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get HtmlContents
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getHtmlContents() {
        $return_collection = new \Doctrine\Common\Collections\ArrayCollection($this->getContents()->filter(function ($content) {
                            return get_class($content) == "Evocatio\Bundle\CmsBundle\Entity\HtmlContent";
                        })->getValues());
        return $return_collection;
    }

    /**
     * Add contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $contents
     * @return Page
     */
    public function addContent(\Evocatio\Bundle\CmsBundle\Entity\Content $contents) {
        $contents->setPage($this);
        $this->contents[] = $contents;

        return $this;
    }

    /**
     * Remove contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $contents
     */
    public function removeContent(\Evocatio\Bundle\CmsBundle\Entity\Content $contents) {
        $this->contents->removeElement($contents);
    }

    /**
     * Get contents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContents() {
        return $this->contents;
    }

}