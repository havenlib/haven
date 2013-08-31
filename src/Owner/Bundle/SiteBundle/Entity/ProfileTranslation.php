<?php

namespace Owner\Bundle\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Haven\Bundle\CoreBundle\Entity\TranslationMappedBase;

class ProfileTranslation extends TranslationMappedBase {

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var text $content
     *
     * @ORM\Column(name="description", type="text", nullable = true)
     */
    private $description;

    /**
     * @var Post parent
     * @ORM\ManyToOne(targetEntity="Profile", inversedBy="translations")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set description
     *
     * @param string $description
     * @return ProfileTranslation
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
     * Set parent
     *
     * @param \Owner\Bundle\SiteBundle\Entity\Profile $parent
     * @return ProfileTranslation
     */
    public function setParent(\Owner\Bundle\SiteBundle\Entity\Profile $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Owner\Bundle\SiteBundle\Entity\Profile 
     */
    public function getParent()
    {
        return $this->parent;
    }
}