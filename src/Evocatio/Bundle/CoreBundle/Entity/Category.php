<?php

namespace Evocatio\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Category extends Translatable {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="CategoryTranslation", mappedBy="parent", cascade={"persist"})
     */
    protected $translations;

    /**
     * @ORM\ManyToMany(targetEntity="\Evocatio\Bundle\WebBundle\Entity\Post", mappedBy="categories", cascade={"persist"})
     */
    protected $posts;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function getName($lang = null) {
        return $this->getTranslated('Name', $lang);
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->translations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add translations
     *
     * @param \Evocatio\Bundle\CoreBundle\Entity\CategoryTranslation $translation
     * @return Category
     */
    public function addTranslation(\Evocatio\Bundle\CoreBundle\Entity\CategoryTranslation $translation) {
        $translation->setParent($this);
        $this->translations[] = $translation;

        return $this;
    }

    /**
     * Remove translations
     *
     * @param \Evocatio\Bundle\CoreBundle\Entity\CategoryTranslation $translation
     */
    public function removeTranslation(\Evocatio\Bundle\CoreBundle\Entity\CategoryTranslation $translation) {
        $this->translations->removeElement($translation);
    }

    /**
     * Get translations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTranslations() {
        return $this->translations;
    }

    /**
     * Add posts
     *
     * @param \Evocatio\Bundle\WebBundle\Entity\Post $post
     * @return Category
     */
    public function addPost(\Evocatio\Bundle\WebBundle\Entity\Post $post) {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Evocatio\Bundle\WebBundle\Entity\Post $post
     */
    public function removePost(\Evocatio\Bundle\WebBundle\Entity\Post $post) {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts() {
        return $this->posts;
    }

    public function __toString() {
        return $this->getName();
    }

}