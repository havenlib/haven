<?php

namespace Evocatio\Bundle\PostBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;

/**
 * Evocatio\Bundle\PostBundle\Entity\Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PostBundle\Entity\PostRepository")
 */
class Post extends Translatable {

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
     * @var datetime $created_at
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;

    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var datetime $postbegin_at
     *
     * @ORM\Column(name="postbegin_at", type="datetime", nullable = true)
     */
    private $postbegin_at;

    /**
     * @var datetime $postend_at
     *
     * @ORM\Column(name="postend_at", type="date", nullable = true)
     */
    private $postend_at;

    /**
     * @ORM\OneToMany(targetEntity="PostTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    public function __construct() {
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
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
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt) {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime
     */
    public function getCreatedAt($format = null) {
        return $format?$this->getFormated($this->created_at,$format):$this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt) {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime
     */
    public function getUpdatedAt($format = null) {
        return $format?$this->getFormated($this->updated_at,$format):$this->updated_at;
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

    /**
     * Set postbegin_at
     *
     * @param datetime $postbeginAt
     */
    public function setPostbeginAt($postbeginAt) {
        $this->postbegin_at = $postbeginAt;
    }

    /**
     * Get postbegin_at
     *
     * @return datetime
     */
    public function getPostbeginAt($format = null) {
        return $format?$this->getFormated($this->postbegin_at,$format):$this->postbegin_at;
    }

    /**
     * Set postend_at
     *
     * @param datetime $postendAt
     */
    public function setPostendAt($postendAt) {
        $this->postend_at = $postendAt;
    }

    /**
     * Get postend_at
     *
     * @return datetime
     */
    public function getPostendAt($format = null) {
        return $format?$this->getFormated($this->postend_at,$format):$this->postend_at;
    }

    /**
     * Add translations
     *
     * @param Evocatio\Bundle\PostBundle\Entity\PostTranslation $translations
     */
    public function addPostTranslation(\Evocatio\Bundle\PostBundle\Entity\PostTranslation $translations) {
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

    public function getContent($lang = null) {
        return $this->getTranslated('content', $lang);
    }

    public function getTitle($lang = null) {
        return $this->getTranslated('title', $lang);
    }

    public function getSubtitle($lang = null) {
        return $this->getTranslated('subtitle', $lang);
    }

    public function getExcerpt($lang = null) {
        return $this->getTranslated('excerpt', $lang);
    }

    public function getName($lang = null) {
        return $this->getTranslated('name', $lang);
    }

    public function getSlug($lang = null) {
        return $this->getTranslated('slug', $lang);
    }

    public function getPath($lang = null) {
        return $this->getTranslated('path', $lang);
    }

    protected function getTranslationClass() {
        return "Evocatio\Bundle\PostBundle\Entity\PostTranslation";
    }

    private function getFormated($date, $format)
    {
        return $date?strftime($format, $date->getTimestamp()):"";
    }

    /**
     * Add translations
     *
     * @param Evocatio\Bundle\PostBundle\Entity\PostTranslation $translations
     * @return Post
     */
    public function addTranslation(\Evocatio\Bundle\PostBundle\Entity\PostTranslation $translations)
    {
        $this->translations[] = $translations;
    
        return $this;
    }

    /**
     * Remove translations
     *
     * @param Evocatio\Bundle\PostBundle\Entity\PostTranslation $translations
     */
    public function removeTranslation(\Evocatio\Bundle\PostBundle\Entity\PostTranslation $translations)
    {
        $this->translations->removeElement($translations);
    }
}