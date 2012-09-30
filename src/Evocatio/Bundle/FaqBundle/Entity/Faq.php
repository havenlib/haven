<?php

namespace Evocatio\Bundle\FaqBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Evocatio\Bundle\CoreBundle\Translatable\Translatable;

/**
 * Evocatio\Bundle\FaqBundle\Entity\Faq
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CoreBundle\Translatable\TranslatableRepository")
 */
class Faq extends Translatable {
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status;
    
    /**
     * @var integer $rank
     *
     * @ORM\Column(name="rank", type="string", length=255, nullable = true)
     */
    private $rank;

    /**
     * @ORM\OneToMany(targetEntity="FaqTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;


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
     * Set status
     *
     * @param boolean $status
     */
    public function setStatus($status) {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Add translations
     *
     * @param Evocatio\Bundle\FaqBundle\Entity\FaqTranslation $translations
     */
    public function addFaqTranslation(\Evocatio\Bundle\FaqBundle\Entity\FaqTranslation $translations) {
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

    public function getReponse($lang = null){
        return $this->getTranslated('Reponse', $lang);
    }

    public function getQuestion($lang = null){
        return $this->getTranslated('Question', $lang);
    }

    protected function getTranslationClass(){
        return "Evocatio\Bundle\FaqBundle\Entity\FaqTranslation";
    }

    /**
     * Set rank
     *
     * @param string $rank
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    }

    /**
     * Get rank
     *
     * @return string 
     */
    public function getRank()
    {
        return $this->rank;
    }
}