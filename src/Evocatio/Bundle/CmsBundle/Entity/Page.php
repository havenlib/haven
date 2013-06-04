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
     * @ORM\OneToMany(targetEntity="PageContent", mappedBy="page", cascade={"persist"})
     */
    private $page_contents;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Template")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     */
    private $template;

    /**
     * @ORM\OneToMany(targetEntity="PageTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    public function __construct() {
        $this->page_contents = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTranslations() {
        return $this->translations;
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
     * Get pages_contents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContents() {
        $return_collection = new \Doctrine\Common\Collections\ArrayCollection();
        foreach ($this->page_contents->getValues() as $page_content) {
            $content = $page_content->getContent();
            $content->setArea($content->getArea() ? $content->getArea() : $page_content->getArea());
            $return_collection->add($content);
        }
        return $return_collection;
    }

    public function getContentsByArea($area) {
        return $this->getContents()->filter(function ($content) use ($area) {
                            return ($content->getArea() == $area);
                        });
    }

    /**
     * Add content
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $contents
     * @return Content
     */
    public function addContent(\Evocatio\Bundle\CmsBundle\Entity\Content $content) {
        $page_content = new PageContent();
        $page_content->setContent($content);
        $page_content->setPage($this);

        $this->addPageContent($page_content);

        return $this;
    }

    /**
     * Remove contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Contents $contents
     */
    public function removeContent(\Evocatio\Bundle\CmsBundle\Entity\Content $content) {
        $page_contents = $this->page_contents->filter(function ($page_content) use ($content) {
                            return $page_content->getContent()->equals($content);
                        })->getValues();
        $this->page_contents->removeElement($page_contents);
    }

    /**
     * Get HtmlContents
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getHtmlContents() {
        $return_collection = new \Doctrine\Common\Collections\ArrayCollection();

        foreach ($this->getContents() as $content) {
            if (get_class($content) == "Evocatio\Bundle\CmsBundle\Entity\HtmlContent")
                $return_collection->add($content);
        }
        return $return_collection;
    }

    /**
     * Add contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $content
     * @return Page
     */
    public function addHtmlContent(\Evocatio\Bundle\CmsBundle\Entity\HtmlContent $content) {
        echo $content->getContent();
        $this->addContent($content);

        return $this;
    }

    /**
     * Remove contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $contents
     */
    public function removeHtmlContent(\Evocatio\Bundle\CmsBundle\Entity\HtmlContent $content) {
        $this->removeContent($content);
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

    /**
     * Add page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     * @return Page
     */
    public function addPageContent(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->page_contents[] = $pageContents;

        return $this;
    }

    /**
     * Remove page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     */
    public function removePageContent(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->page_contents->removeElement($pageContents);
    }

    /**
     * Get page_contents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPageContents() {
        return $this->page_contents;
    }

}