<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CmsBundle\Repository\CmsPageRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="nom", type="string")
 * @ORM\DiscriminatorMap({"accueil" = "CmsPageAccueil", "page" = "CmsPage"})
 */
class CmsPage {

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
     * @return ArrayCollection<CmsContent> $cms_content
     * 
     * @ORM\OneToMany(targetEntity="CmsContent", mappedBy="cms_page", cascade={"persist"})
     */
    private $cms_contents;

    public function __construct() {
        $this->cms_contents = new \Doctrine\Common\Collections\ArrayCollection();
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

}