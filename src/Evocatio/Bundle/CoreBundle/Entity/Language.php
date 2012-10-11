<?php

namespace Evocatio\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Lib\Locale;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;

/**
 * Evocatio\Bundle\CoreBundle\Entity\Language
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LanguageRepository")
 */
class Language extends Translatable {
    const STATUS_INACTIVE = 0;
    const STATUS_PUBLISH = 1;
    const STATUS_DRAFT = 2;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $symbol
     *
     * @ORM\Column(name="symbol", type="string", length=8)
     */
    private $symbol;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="LanguageTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="Culture", mappedBy="language", cascade={"persist", "merge"})
     */
    protected $cultures;

    public function __construct() {
        $this->status = false;
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cultures = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set symbol
     *
     * @param string $symbol
     */
    public function setSymbol($symbol) {
        $this->symbol = $symbol;
    }

    /**
     * Get symbol
     *
     * @return string 
     */
    public function getSymbol() {
        return $this->symbol;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status) {
        if (!in_array($status, array(self::STATUS_INACTIVE, self::STATUS_PUBLISH, self::STATUS_DRAFT))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus() {
        return $this->status;
    }

    public function getName($lang = null) {
        return $this->getTranslated('Name', $lang);
    }

    /**
     * Add translations
     *
     * @param Evocatio\Bundle\CoreBundle\Entity\LanguageTranslation $translations
     */
    public function addLanguageTranslation(\Evocatio\Bundle\CoreBundle\Entity\LanguageTranslation $translations) {
        $this->translations[] = $translations;
    }

    /**
     * Get translations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTranslations() {
        return $this->translations;
    }

    protected function getTranslationClass() {
        return "Evocatio\Bundle\CoreBundle\Entity\LanguageTranslation";
    }

    /**
     * Add cultures
     *
     * @param Evocatio\Bundle\CoreBundle\Entity\Culture $cultures
     */
    public function addCulture(\Evocatio\Bundle\CoreBundle\Entity\Culture $cultures) {
        $this->cultures[] = $cultures;
    }

    /**
     * Get cultures
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCultures() {
        return $this->cultures;
    }

    /**
     * Add translations
     *
     * @param Evocatio\Bundle\CoreBundle\Entity\LanguageTranslation $translations
     * @return Language
     */
    public function addTranslation(\Evocatio\Bundle\CoreBundle\Entity\LanguageTranslation $translations) {
        $this->translations[] = $translations;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param Evocatio\Bundle\CoreBundle\Entity\LanguageTranslation $translations
     */
    public function removeTranslation(\Evocatio\Bundle\CoreBundle\Entity\LanguageTranslation $translations) {
        $this->translations->removeElement($translations);
    }

    /**
     * Remove cultures
     *
     * @param Evocatio\Bundle\CoreBundle\Entity\Culture $cultures
     */
    public function removeCulture(\Evocatio\Bundle\CoreBundle\Entity\Culture $cultures) {
        $this->cultures->removeElement($cultures);
    }

    public function refreshTranslations($languages) {
        $this->addTranslations($languages);
        foreach ($this->getTranslations() as $translation) {
            $translation->setName(Locale::getDisplayLanguage($this->getSymbol(), $translation->getTransLang()->getSymbol()));
        }
    }

    public function refreshMyCulturesTranslations($languages) {
        foreach ($this->getCultures() as $culture) {
            $culture->refreshTranslations($languages);
        }
    }

}