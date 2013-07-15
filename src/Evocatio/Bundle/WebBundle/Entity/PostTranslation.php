<?php

namespace Evocatio\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Evocatio\Bundle\CoreBundle\Entity\SluggableMappedBase;

/**
 * Evocatio\Bundle\WebBundle\Entity\PostTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PostTranslation extends SluggableMappedBase {

    const STATUS_INACTIVE = 0;
    const STATUS_PUBLISHED = 1;
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
     * @var text $content
     *
     * @ORM\Column(name="content", type="text", nullable = true)
     */
    private $content;

    /**
     * @var text $title
     *
     * @ORM\Column(name="title", type="string", length = 1024, nullable = true)
     */
    private $title;

    /**
     * @var string $subtitle
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    protected $subtitle;

    /**
     * @var text $excerpt
     *
     * @ORM\Column(name="excerpt", type="text", nullable = true)
     */
    private $excerpt;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255, nullable = true)
     */
    private $name;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $file;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    protected $path;

    /**
     * @var Post parent
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="translations")
     * @ORM\JoinColumn(name="Post_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function getFile() {
        return $this->file;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set title
     *
     * @param text $title
     */
    public function setTitle($title) {
        $this->title = $title;
//        sets the title as the slug
    }

    /**
     * Get title
     *
     * @return text 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set excerpt
     *
     * @param text $excerpt
     */
    public function setExcerpt($excerpt) {
        $this->excerpt = $excerpt;
    }

    /**
     * Get excerpt
     *
     * @return text 
     */
    public function getExcerpt() {
        return $this->excerpt;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
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
     * @param Evocatio\Bundle\WebBundle\Entity\Post $parent
     */
    public function setParent(\Evocatio\Bundle\WebBundle\Entity\Post $parent) {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Evocatio\Bundle\WebBundle\Entity\Post 
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * Set path
     *
     * @param string $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     */
    public function setSubtitle($subtitle) {
        $this->subtitle = $subtitle;
    }

    /**
     * Get subtitle
     *
     * @return string 
     */
    public function getSubtitle() {
        return $this->subtitle;
    }


    /**
     * Set status
     *
     * @param integer $status
     * @return PostTranslation
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