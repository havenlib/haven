<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Evocatio\Bundle\PosBundle\Entity\ProductTranslation;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Evocatio\Bundle\PosBundle\Entity\Product
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PosBundle\Entity\ProductRepository")
 */
class Product extends ProductMappedBase
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
     * @var string $Titre
     * 
     * @ORM\Column(name="Titre", type="string", length=255)
     */
    protected $Titre;

    /**
     * @var integer $quantite
     *
     * @ORM\Column(name="quantite", type="integer", length=8, nullable=true)
     */
    protected $quantite;
    
//
//    /**
//     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
//     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
//     */
//    
//    protected $category;

    /**
     * @var string $unite
     * @ORM\Column(name="unite", type="string", length=16, nullable=true)
     */
    protected $unite;



    /**
     * @var boolean $Kasher
     *
     * @ORM\Column(name="Kasher", type="boolean")
     */
    protected $Kasher;




    /**
     * @var integer $Poids
     * @ORM\Column(name="Poids", type="integer", length=255, nullable=true)
     */
    protected $Poids;
    
    
    /**
     *
     * @var type ArrayCollection<Product>
     * 
     * @ORM\ManyToMany(targetEntity="Product")
     * @ORM\JoinTable(name="ProductComplement",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="complement_id", referencedColumnName="id")})
     */
    protected $complements;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    protected function getTranslationClass(){
        return "Evocatio\Bundle\PosBundle\Entity\ProductTranslation";
    }

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
     * Add translations
     *
     * @param Evocatio\Bundle\PosBundle\Entity\ProductTranslation $translations
     */
    public function addProductTranslation(\Evocatio\Bundle\PosBundle\Entity\ProductTranslation $translations)
    {
        $this->translations[] = $translations;
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
     * Set Titre
     *
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->Titre = $titre;
    }

    /**
     * Get Titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->Titre;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set unite
     *
     * @param string $unite
     */
    public function setUnite($unite)
    {
        $this->unite = $unite;
    }

    /**
     * Get unite
     *
     * @return string 
     */
    public function getUnite()
    {
        return $this->unite;
    }

    /**
     * Set Kasher
     *
     * @param boolean $kasher
     */
    public function setKasher($kasher)
    {
        $this->Kasher = $kasher;
    }

    /**
     * Get Kasher
     *
     * @return boolean 
     */
    public function getKasher()
    {
        return $this->Kasher;
    }

    /**
     * Set Poids
     *
     * @param integer $poids
     */
    public function setPoids($poids)
    {
        $this->Poids = $poids;
    }

    /**
     * Get Poids
     *
     * @return integer 
     */
    public function getPoids()
    {
        return $this->Poids;
    }

    /**
     * Add complements
     *
     * @param Evocatio\Bundle\PosBundle\Entity\Product $complements
     */
    public function addProduct(\Evocatio\Bundle\PosBundle\Entity\Product $complements)
    {
        $this->complements[] = $complements;
    }

    /**
     * Get complements
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComplements()
    {
        return $this->complements;
    }
// -----------------

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto($lang = null){
        return $this->getTranslated('Photo', $lang);
    }
    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription($lang = null){
        return $this->getTranslated('Description', $lang);
    }

    /**
     * Get caracteristique
     *
     * @return text 
     */
    public function getCaracteristique($lang = null){
        return $this->getTranslated('Caracteristique', $lang);
    }

    /**
     * Get Introduction
     *
     * @return text 
     */
    public function getIntroduction($lang = null){
        return $this->getTranslated('Introduction', $lang);
    }

    /**
     * Get Avertissement
     *
     * @return text 
     */
    public function getAvertissement($lang = null){
        return $this->getTranslated('Avertissement', $lang);
    }

    /**
     * Get contre_indications
     *
     * @return text 
     */
    public function getContreIndications($lang = null){
        return $this->getTranslated('ContreIndications', $lang);
    }

    /**
     * Get mise_en_garde
     *
     * @return text 
     */
    public function getMiseEnGarde($lang = null){
        return $this->getTranslated('MiseEnGarde', $lang);
    }

    /**
     * Get ingredients
     *
     * @return text 
     */
    public function getIngredients($lang = null){
        return $this->getTranslated('Ingredients', $lang);
    }    
}