<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;

/**
 * Evocatio\Bundle\CmsBundle\Entity\Content
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CmsBundle\Repository\ContentRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 * "html"="Evocatio\Bundle\CmsBundle\Entity\HtmlContent", 
 * })
 */
class Content extends Translatable {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=254, unique=true, nullable=false)
     */
    protected $name;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status;

    /**
     *
     * @var type Page $cms_page
     * 
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="contents")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    protected $page;

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

    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTranslations() {
        return $this->translations;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     */
    public function setActif($actif) {
        $this->actif = $actif;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif() {
        return $this->actif;
    }

    /**
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom) {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom() {
        return $this->nom;
    }

    public function setLanguage() {
        if ($this->getTranslations()->exists(function ($current) {
                            return ($current->getLang() == \Locale::getPrimaryLanguage(\Locale::getDefault()));
                        }))
            ;
    }

    public function getContent() {
        return $this->getTranslations()->current()->getContent();
    }

    public function setContent() {
        $this->getTranslations()->next();
    }

    public function __toString() {
        return $this->getContent();
    }

    /**
     * Set cms_page
     *
     * @param tahua\SiteBundle\Entity\Page $cmsPage
     */
    public function setCmsPage(\tahua\SiteBundle\Entity\Page $cmsPage) {
        $this->cms_page = $cmsPage;
    }

    public function getTranslationByLang($lang) {
        return $this->translations->filter(function ($row) use ($lang) {
                            return $row->getLang() === $lang;
                        })->first();
    }

    public function createMissingLanguages() {
        foreach ($this->langs as $lang) {
            if (!($this->getTranslationByLang($lang) instanceof CmsContentTranslation)) {
                $this->translations[$lang] = $this->createTranslation($lang);
            }
        }
    }

    /**
     * Change l'index numérique par la langue
     */
    public function indexContentTranslationsByLang() {
        foreach ($this->translations as $key => $translation) {
            $this->translations[$translation->getLang()] = $this->translations->remove($key);
        }
    }

    public function createTranslation($lang) {
        $translation = new CmsContentTranslation();
        $translation->setLang($lang);
        $translation->setCmsContent($this);

        return $translation;
    }

    /**
     * Get cms_page
     *
     * @return tahua\SiteBundle\Entity\Page 
     */
    public function getCmsPage() {
        return $this->cms_page;
    }


    /**
     * Set page
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Page $page
     * @return Content
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
     * Set name
     *
     * @param string $name
     * @return Content
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Content
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
}