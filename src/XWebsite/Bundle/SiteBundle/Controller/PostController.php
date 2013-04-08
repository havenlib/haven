<?php

namespace Website\Bundle\SiteBundle\Controller;

// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Evocatio\Bundle\WebBundle\Controller\PostController as BasePostController;


class PostController extends BasePostController {
    
    /**
     * @Route("/post/{slug}", name="EvocatioWebBundle_PostShowSlug")
     * @Method("GET")
     * @Template("WebsiteSiteBundle:Post:show.html.twig")
     */
//    public function showFromSlugAction(EntityTranslation $entityTranslation) {
//        return parent::showFromSlugAction($entityTranslation);
//    }

}
