<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * tahua\SiteBundle\Entity\CmsContentTranslation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class CmsContentTranslation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @var type $lang
     * 
     * @ORM\Column(name="lang", type="text")
     */
    protected $lang;
    
    /**
     * @var text $content
     * 
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;

    /**
     * @Orm\ManyToOne(targetEntity="CmsContent", inversedBy="translations")
     * @Orm\JoinColumn(name="cms_content_id", referencedColumnName="id")
     **/
    protected $cms_content;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set lang
     *
     * @param text $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Get lang
     *
     * @return text 
     */
    public function getLang()
    {
        return $this->lang;
    }


    
    public function setTranslatedParent($parent){
        $this->setCmsContent($parent);
    }



    /**
     * Set cms_page
     *
     * @param tahua\SiteBundle\Entity\Page $cmsPage
     */
    public function setCmsPage(\tahua\SiteBundle\Entity\Page $cmsPage)
    {
        $this->cms_page = $cmsPage;
    }

    /**
     * Get cms_page
     *
     * @return tahua\SiteBundle\Entity\Page 
     */
    public function getCmsPage()
    {
        return $this->cms_page;
    }

    /**
     * Set cms_content
     *
     * @param tahua\SiteBundle\Entity\CmsContent $cmsContent
     */
    public function setCmsContent(\tahua\SiteBundle\Entity\CmsContent $cmsContent)
    {
        $this->cms_content = $cmsContent;
    }

    /**
     * Get cms_content
     *
     * @return tahua\SiteBundle\Entity\CmsContent 
     */
    public function getCmsContent()
    {
        return $this->cms_content;
    }
}