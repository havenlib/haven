<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;

/**
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CmsBundle\Repository\PageRepository")
 */
class Page extends Translatable {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="Content", cascade={"persist"})
     * @ORM\JoinTable(name="PagesContents",
     *      joinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="content_id", referencedColumnName="id")}
     *      )
     */
    private $contents;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Template")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     */
    private $template;

    /**
     * @ORM\OneToMany(targetEntity="PageTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    public function __construct() {
        $this->contents = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add translations
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageTranslation $translations
     * @return Page
     */
    public function addTranslation(\Evocatio\Bundle\CmsBundle\Entity\PageTranslation $translations) {
        $translations->setParent($this);
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageTranslation $translations
     */
    public function removeTranslation(\Evocatio\Bundle\CmsBundle\Entity\PageTranslation $translations) {
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
     * Add contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $contents
     * @return Page
     */
    public function addHtmlContent(\Evocatio\Bundle\CmsBundle\Entity\HtmlContent $contents) {
        $this->addContent($contents);

        return $this;
    }

    /**
     * Remove contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $contents
     */
    public function removeHtmlContent(\Evocatio\Bundle\CmsBundle\Entity\HtmlContent $contents) {
        $this->removeContent($contents);
    }

    /**
     * Set template
     *
     * @param string $template
     * @return Page
     */
    public function setTemplate($template) {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return string 
     */
    public function getTemplate() {
        return $this->template;
    }

}