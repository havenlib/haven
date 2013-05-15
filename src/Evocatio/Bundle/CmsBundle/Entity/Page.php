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
    protected $cms_page_content_list = array();

    /**
     *
     * @return ArrayCollection<CmsContent> $content
     * 
     * @ORM\OneToMany(targetEntity="Content", mappedBy="page", cascade={"persist"})
     */
    private $contents;

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
     * Get cms_contents
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCmsContents() {
        return $this->cms_contents;
    }

    public function getCmsContentByName($content_name) {
        return $this->cms_contents->filter(function ($row) use ($content_name) {
                            return $row->getNom() === $content_name;
                        })->first();
    }

    /**
     * Change l'index numérique par le nom du content
     */
    public function indexCmsContentsByNames() {
        foreach ($this->cms_contents as $key => $cms_content) {
            $this->cms_contents[$cms_content->getNom()] = $this->cms_contents->remove($key);
        }
    }

    /**
     * Add cms_contents
     *
     * @param tahua\SiteBundle\Entity\CmsContent $cmsContents
     */
    public function addCmsContent(\tahua\SiteBundle\Entity\CmsContent $cmsContent) {
        $this->cms_contents[] = $cmsContent;
    }

    public function createMissingContent() {
        foreach ($this->cms_page_content_list as $cms_page_content) {

            if (!($this->getCmsContentByName($cms_page_content) instanceof CmsContent))
                $this->cms_contents[] = $this->createContent($cms_page_content);
        }
    }

    private function createContent($nom) {
        $content = new CmsContent();
        $content->setNom($nom);
        $content->setCmsPage($this);

        return $content;
    }

    /**
     * Create missing Contents.
     * Index all contents by name.
     */
    public function createMissingAndIndexContents() {
        $this->createMissingContent();
        $this->indexCmsContentsByNames();

        foreach ($this->getCmsContents() as $cms_content) {
            $cms_content->createMissingLanguages();
            $cms_content->indexContentTranslationsByLang();
        }
    }

    /**
     * Remove cms_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\CmsContent $cmsContents
     */
    public function removeCmsContent(\Evocatio\Bundle\CmsBundle\Entity\CmsContent $cmsContents) {
        $this->cms_contents->removeElement($cmsContents);
    }

    /**
     * Add translations
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageTranslation $translations
     * @return Page
     */
    public function addTranslation(\Evocatio\Bundle\CmsBundle\Entity\PageTranslation $translations) {
        $this->translations[] = $translations;

        return $this;
    }

    protected function getTranslationClass() {
        return "Evocatio\Bundle\CmsBundle\Entity\PageTranslation";
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
     * Get coordinate
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getHtmlContents() {
        return $this->getContents()->filter(function ($coordinate) {
                            return get_class($coordinate) == "Evocatio\Bundle\CmsBundle\Entity\HtmlContent";
                        });
    }

    /**
     * Add contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $contents
     * @return Page
     */
    public function addContent(\Evocatio\Bundle\CmsBundle\Entity\Content $contents) {
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