<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Entity\TranslationMappedBase;

/**
 * WidgetTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class WidgetTranslation extends TranslationMappedBase {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="string", type="string", nullable=true)
     */
    private $name;


    /**
     * @ORM\ManyToOne(targetEntity="Widget", inversedBy="translations")
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id", onDelete="CASCADE")
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
     * Set content
     *
     * @param string $content
     * @return WidgetTranslation
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set parent
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\HtmlContent $parent
     * @return WidgetTranslation
     */
    public function setParent(\Evocatio\Bundle\CmsBundle\Entity\HtmlContent $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Evocatio\Bundle\CmsBundle\Entity\HtmlContent 
     */
    public function getParent() {
        return $this->parent;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return WidgetTranslation
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
}