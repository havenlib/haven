<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagesContents
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PageContent {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="page_contents", cascade={"persist"})
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id")
     * */
    private $page;

    /**
     * @ORM\ManyToOne(targetEntity="Content", inversedBy="page_contents", cascade={"persist"})
     * @ORM\JoinColumn(name="content_id", referencedColumnName="id")
     * */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="area", type="string", length=255, nullable=true)
     */
    private $area;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set page
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Page $page
     * @return PagesContents
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
     * Set content
     *
     * @param \Evocatio\Bundle\CmsBundle\Entity\Content $content
     * @return PagesContents
     */
    public function setContent(\Evocatio\Bundle\CmsBundle\Entity\Content $content = null) {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return \Evocatio\Bundle\CmsBundle\Entity\Content 
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set area
     *
     * @param string $area
     * @return PageContent
     */
    public function setArea($area) {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string 
     */
    public function getArea() {
        return $this->area;
    }

}