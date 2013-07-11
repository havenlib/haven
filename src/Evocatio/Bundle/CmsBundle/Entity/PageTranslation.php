<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Evocatio\Bundle\CoreBundle\Entity\SluggableMappedBase;

/**
 * PageTranslation
 *
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="slug_unique",columns={"trans_lang_id","slug"})})
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CmsBundle\Repository\PageTranslationRepository")
 */
class PageTranslation extends SluggableMappedBase {

    const STATUS_INACTIVE = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="translations")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    public function __construct() {
        $this->setStatus(self::STATUS_DRAFT);
        parent::construct;
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
     * Set name
     *
     * @param string $name
     * @return PageTranslation
     */
    public function setName($name) {

        $this->name = $name;
        $this->setSlug($name);

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set parent
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Page $parent
     * @return PageTranslation
     */
    public function setParent(\Evocatio\Bundle\CmsBundle\Entity\Page $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Evocatio\Bundle\CmsBundle\Entity\Page 
     */
    public function getParent() {
        return $this->parent;
    }


    /**
     * Set status
     *
     * @param integer $status
     * @return PageTranslation
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}