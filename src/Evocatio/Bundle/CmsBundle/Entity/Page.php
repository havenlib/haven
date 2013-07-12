<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\Valid
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

    public function getTitle($lang = null) {
        return $this->getTranslated('Title', $lang);
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

    /**
     * Add page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     * @return Page
     */
    public function addHtmlContent(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $pageContents->setPage($this);
        $this->page_contents[] = $pageContents;

        return $this;
    }

    /**
     * Remove page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     */
    public function removeHtmlContent(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->page_contents->removeElement($pageContents);
    }

    /**
     * Get page_contents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHtmlContents() {
        $return_collection = new \Doctrine\Common\Collections\ArrayCollection($this->getPageContents()->filter(function ($pageContents) {
                            return get_class($pageContents->getContent()) == "Evocatio\Bundle\CmsBundle\Entity\HtmlContent";
                        })->getValues());

        return $return_collection;
    }

    /**
     * Add page_contents for textcontent type
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     * @return Page
     */
    public function addTextContent(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $pageContents->setPage($this);
        $this->page_contents[] = $pageContents;

        return $this;
    }

    /**
     * Remove page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     */
    public function removeTextContent(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->page_contents->removeElement($pageContents);
    }

    /**
     * Get page_contents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTextContents() {
        $return_collection = new \Doctrine\Common\Collections\ArrayCollection($this->getPageContents()->filter(function ($pageContents) {
                            return get_class($pageContents->getContent()) == "Evocatio\Bundle\CmsBundle\Entity\TextContent";
                        })->getValues());

        return $return_collection;
    }

    /**
     * Add page_contents for textcontent type
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     * @return Page
     */
    public function addWidget(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $pageContents->setPage($this);
        $this->page_contents[] = $pageContents;

        return $this;
    }

    /**
     * Remove page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     */
    public function removeWidget(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->page_contents->removeElement($pageContents);
    }

    /**
     * Get page_contents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWidgets() {
        $return_collection = new \Doctrine\Common\Collections\ArrayCollection($this->getPageContents()->filter(function ($pageContents) {
                            return get_class($pageContents->getContent()) == "Evocatio\Bundle\CmsBundle\Entity\Widget";
                        })->getValues());

        return $return_collection;
    }

    /**
     * Add page_contents for textcontent type
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     * @return Page
     */
    public function addNewsWidget(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->addWidget($pageContents);

        return $this;
    }

    /**
     * Remove page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     */
    public function removeNewsWidget(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->removeWidget($pageContents);
    }

    public function getNewsWidgets() {
        $return_collection = new \Doctrine\Common\Collections\ArrayCollection($this->getPageContents()->filter(function ($pageContents) {
                            return get_class($pageContents->getContent()) == "Evocatio\Bundle\CmsBundle\Entity\NewsWidget";
                        })->getValues());

        return $return_collection;
    }

    /**
     * Add files
     *
     * @param Website\Bundle\SiteBundle\Entity\FileCredit $files
     * @return ServiceCredit
     */
    public function addFile(FilePage $files) {
        $files->setParent($this);
        $this->files[] = $files;

        return $this;
    }

    /**
     * Remove files
     *
     * @param Website\Bundle\SiteBundle\Entity\FileCredit $files
     */
    public function removeFile(FilePage $files) {
        $files->setParent(NULL);
        $this->files->removeElement($files);
    }

    /**
     * Get files
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getFiles() {
        return $this->files;
    }

}