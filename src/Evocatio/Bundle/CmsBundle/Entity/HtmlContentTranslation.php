<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Entity\TranslationMappedBase;

/**
 * HtmlContentTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class HtmlContentTranslation extends TranslationMappedBase {

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
     * @ORM\Column(name="html", type="text")
     */
    private $html;

    /**
     * @ORM\ManyToOne(targetEntity="HtmlContent", inversedBy="translations")
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
     * Set html
     *
     * @param string $html
     * @return HtmlContentTranslation
     */
    public function setHtml($html) {
        $this->html = $html;

        return $this;
    }

    /**
     * Get html
     *
     * @return string 
     */
    public function getHtml() {
        return $this->html;
    }


    /**
     * Set parent
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\HtmlContent $parent
     * @return HtmlContentTranslation
     */
    public function setParent(\Evocatio\Bundle\CmsBundle\Entity\HtmlContent $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Evocatio\Bundle\CmsBundle\Entity\HtmlContent 
     */
    public function getParent()
    {
        return $this->parent;
    }
}