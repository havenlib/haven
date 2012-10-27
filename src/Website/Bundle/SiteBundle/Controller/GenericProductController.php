<?php

namespace Website\Bundle\SiteBundle\Controller;

// Sensio includes
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class GenericProductController extends \Evocatio\Bundle\PosBundle\Controller\GenericProductController {

    /**
     * Creates a new entity.
     *
     * @Route("/new", name="EvocatioPosBundle_GenericProductCreate")
     * @Method("POST")
     * @Template("WebsiteSiteBundle:Default:new.html.twig")
     */
    public function createAction() {
        return parent::createAction();
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_GenericProductUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("WebsiteSiteBundle:Default:edit.html.twig")
     */
    public function updateAction($id) {
        return parent::updateAction($id);
    }

}
