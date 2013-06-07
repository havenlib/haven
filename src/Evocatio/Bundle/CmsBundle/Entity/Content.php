<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;
use Doctrine\Common\Annotations\AnnotationReader;
use \ReflectionClass;

/**
 * Evocatio\Bundle\CmsBundle\Entity\Content
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CmsBundle\Repository\ContentRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 * "html"="Evocatio\Bundle\CmsBundle\Entity\HtmlContent", 
 * "text"="Evocatio\Bundle\CmsBundle\Entity\TextContent", 
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
     * @ORM\OneToMany(targetEntity="PageContent", mappedBy="content", cascade={"persist"})
     */
    private $page_contents;

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
        return $this->id;
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

    /**
     * Constructor
     */
    public function __construct() {
        $this->page_contents = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     * @return Content
     */
    public function addPageContent(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->page_contents[] = $pageContents;

        return $this;
    }

    /**
     * Remove page_contents
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents
     */
    public function removePageContent(\Evocatio\Bundle\CmsBundle\Entity\PageContent $pageContents) {
        $this->page_contents->removeElement($pageContents);
    }

    /**
     * Get page_contents
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPageContents() {
        return $this->page_contents;
    }

    public static function getDiscriminatorMap() {
        $reader = new AnnotationReader();
        return $reader->getClassAnnotation(new ReflectionClass(__CLASS__), "\Doctrine\ORM\Mapping\DiscriminatorMap");
    }

    public function getDiscriminator() {
        $discriminator_map = self::getDiscriminatorMap();
        return array_search(get_class($this), $discriminator_map->value);
    }

    public function is($class) {
        return get_class($this) === $class;
    }

//    public function equals($content) {
//        return ($this->getId() === $content->getId());
//    }
}