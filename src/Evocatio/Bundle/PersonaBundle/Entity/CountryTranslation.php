<?php

namespace Evocatio\Bundle\PersonaBundle\Entity;

use Evocatio\Bundle\PersonaBundle\Entity\Country;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evocatio\Bundle\PersonaBundle\Entity\CountryTranslation
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class CountryTranslation {
    
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
    * @ORM\Column(name="name", type="string", length=255)
    */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="translations")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", onDelete="CASCADE")
     */ 
    protected $country;
    
    /**
     *
     * @var type $lang
     * 
     * @ORM\Column(name="lang", type="text")
     */
    protected $lang;
    
    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set country
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Country $country
     */
    public function setCountry(\Evocatio\Bundle\PersonaBundle\Entity\Country $country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
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
     * Set lang
     *
     * @param text $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Get lang
     *
     * @return text 
     */
    public function getLang()
    {
        return $this->lang;
    }
}