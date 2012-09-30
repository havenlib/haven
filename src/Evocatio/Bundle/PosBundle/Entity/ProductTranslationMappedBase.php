<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\PosBundle\Entity\Product;
use Symfony\Component\Validator\Constraints as Assert;
use Evocatio\Bundle\CoreBundle\Entity\TranslationMappedBase;

/**
 * Evocatio\Bundle\CoreBundle\Entity\TranslationMappedBase
 *
 * @ORM\MappedSuperclass
 */
abstract class ProductTranslationMappedBase extends TranslationMappedBase {

    /**
     * @var string $photo
     * 
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="translations")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * Set photo
     *
     * @param string $photo
     */
    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * Set parent
     *
     * @param Evocatio\Bundle\PosBundle\Entity\Product $parent
     */
    public function setParent(\Evocatio\Bundle\PosBundle\Entity\Product $parent) {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Evocatio\Bundle\PosBundle\Entity\Product 
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription() {
        return $this->description;
    }

    public function getFile() {
        return $this->file;
    }

}