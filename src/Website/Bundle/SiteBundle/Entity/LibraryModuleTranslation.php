<?php

namespace Website\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Evocatio\Bundle\CoreBundle\Entity\TranslationMappedBase;
/**
 * Website\Bundle\SiteBundle\Entity\LibraryModuleTranslation
 *
 * @ORM\Entity()
 */
class LibraryModuleTranslation extends TranslationMappedBase
{
        /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    
    /**
     * @var text $name
     *
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="LibraryModule", inversedBy="translations")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;
    

    /**
     * Set name
     *
     * @param string $name
     * @return LibraryModuleTranslation
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
     * Set description
     *
     * @param string $description
     * @return LibraryModuleTranslation
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set parent
     *
     * @param LibraryModule $parent
     * @return LibraryModuleTranslation
     */
    public function setParent(LibraryModule $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return Evocatio\Bundle\PosBundle\Entity\LibraryModule
     */
    public function getParent()
    {
        return $this->parent;
    }
}