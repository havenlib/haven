<?php

namespace Website\Bundle\SiteBundle\Controller;

// Sensio includes
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class PostController extends \Evocatio\Bundle\PostBundle\Controller\PostController {

    /**
     * Creates a new post entity.
     *
     * @Route("/new", name="EvocatioPostBundle_PostCreate")
     * @Method("POST")
     * @Template("WebsiteSiteBundle:Post:new.html.twig")
     */
    public function createAction() {
        return parent::createAction();
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPostBundle_PostUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("WebsiteSiteBundle:Post:edit.html.twig")
     */
    public function updateAction($id) {
        return parent::updateAction($id);
    }

}
