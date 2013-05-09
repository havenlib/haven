<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use tahua\SiteBundle\Entity\CmsPage;

/**
 * tahua\SiteBundle\Entity\CmsPageAccueil
 *
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\CmsBundle\Repository\CmsPageAccueilRepository")
 */
class CmsPageAccueil extends CmsPage {

    protected $cms_page_content_list = array("text", "box1", "box2", "box3");

}