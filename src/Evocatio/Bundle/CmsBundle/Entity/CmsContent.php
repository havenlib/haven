<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * tahua\SiteBundle\Entity\CmsContent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CmsBundle\Repository\CmsContentRepository")
 */
class CmsContent
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $nom
     *
     * @ORM\Column(name="nom", type="string", length=254, unique=true, nullable=false)
     */
    protected $nom;


    /**
     * @var boolean $actif
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    protected $actif;
    
    
    /**
     *
     * @var type CmsPage $cms_page
     * 
     * @ORM\ManyToOne(targetEntity="CmsPage", inversedBy="cms_contents")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     */
    protected $cms_page;
    
    /**
     * Available languages.
     */
    protected $langs = array("en", "fr");
    
    /**
     * @ORM\OneToMany(targetEntity="CmsContentTranslation", mappedBy="cms_content", cascade={"persist"})
     */
    protected $translations;
    
    public function __construct()
    {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    
    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     */
    public function setActif($actif)
    {
        $this->actif = $actif;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function setLanguage(){
        if($this->getTranslations()->exists(function ($current){
            return ($current->getLang() == \Locale::getPrimaryLanguage(\Locale::getDefault()));
            }));
    }

    public function getContent(){
        return $this->getTranslations()->current()->getContent();
    }

    public function setContent(){
         $this->getTranslations()->next();
    }

    public function __toString(){
        return $this->getContent();
    }




    /**
     * Add translations
     *
     * @param tahua\SiteBundle\Entity\CmsContentTranslation $translations
     */
    public function addCmsContentTranslation(\tahua\SiteBundle\Entity\CmsContentTranslation $translations)
    {
        $this->translations[] = $translations;
    }

    /**
     * Set cms_page
     *
     * @param tahua\SiteBundle\Entity\CmsPage $cmsPage
     */
    public function setCmsPage(\tahua\SiteBundle\Entity\CmsPage $cmsPage)
    {
        $this->cms_page = $cmsPage;
    }
    
    
    public function getTranslationByLang($lang){
            return $this->translations->filter(function ($row) use ($lang){ return $row->getLang() === $lang;})->first();
    }
    
    public function createMissingLanguages(){
        foreach ($this->langs as $lang){
            if(!($this->getTranslationByLang($lang) instanceof CmsContentTranslation)){
                $this->translations[$lang] = $this->createTranslation($lang); 
            }
        }
    }
    
    /**
     * Change l'index numérique par la langue
     */
    public function indexContentTranslationsByLang(){
        foreach ($this->translations as $key => $translation){
            $this->translations[$translation->getLang()] = $this->translations->remove($key);
        }
    }
    
    public function createTranslation($lang){
        $translation = new CmsContentTranslation();
        $translation->setLang($lang);
        $translation->setCmsContent($this);
        
        return $translation;
    }

    /**
     * Get cms_page
     *
     * @return tahua\SiteBundle\Entity\CmsPage 
     */
    public function getCmsPage()
    {
        return $this->cms_page;
    }
}