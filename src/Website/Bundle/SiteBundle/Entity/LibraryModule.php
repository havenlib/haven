<?php

namespace Website\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Website\Bundle\SiteBundle\Entity\LibraryModuleTranslation;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;

/**
 *  Website\Bundle\SiteBundle\Entity\LibraryModule
 * 
* @ORM\Entity(repositoryClass="Evocatio\Bundle\CoreBundle\Generic\StatusRepository")
 */
class LibraryModule extends \Evocatio\Bundle\PosBundle\Entity\Product {

    /**
     * @ORM\OneToMany(targetEntity="LibraryModuleTranslation", mappedBy="parent", cascade={"persist"})
     */
    private $translations;

    protected function getTranslationClass() {
        return "Website\Bundle\SiteBundle\Entity\LibraryModuleTranslation";
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
     * @param Website\Bundle\SiteBundle\Entity\LibraryModuleTranslation $translations
     * @return LibraryModule
     */
    public function addTranslation(\Website\Bundle\SiteBundle\Entity\LibraryModuleTranslation $translations) {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param Website\Bundle\SiteBundle\Entity\LibraryModuleTranslation $translations
     */
    public function removeTranslation(\Website\Bundle\SiteBundle\Entity\LibraryModuleTranslation $translations) {
        $this->translations->removeElement($translations);
    }

    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTranslations() {
        return $this->translations;
    }

    public function getName($lang = null) {
        return $this->getTranslated('Name', $lang);
    }

    /**
     * Description must return an overall description of the product,
     * For non-generic it should return a concatenation of other descriptive fields,
     * @param type $lang
     * @return type
     */
    public function getDescription($lang = null) {
        return $this->getTranslated('Description', $lang);
    }

}