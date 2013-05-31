<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;

/**
 * Evocatio\Bundle\CmsBundle\Entity\Content
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CmsBundle\Repository\ContentRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 * "html"="Evocatio\Bundle\CmsBundle\Entity\HtmlContent", 
 * })
 */
class Content extends Translatable {

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
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set actif
     *
     * @param boolean $actif
     */
    public function setActif($actif) {
        $this->actif = $actif;
    }

    /**
     * Get actif
     *
     * @return boolean 
     */
    public function getActif() {
        return $this->actif;
    }

    public function __toString() {
        return $this->getContent();
    }

    /**
     * Set page
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Page $page
     * @return Content
     */
    public function setPage(\Evocatio\Bundle\CmsBundle\Entity\Page $page = null) {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \Evocatio\Bundle\CmsBundle\Entity\Page 
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Content
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus() {
        return $this->status;
    }

}