<?php

namespace Website\Bundle\SiteBundle\Controller;

// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ProductAdminController extends \Evocatio\Bundle\PosBundle\Controller\ProductAdminController{

    /**
     * Creates a new product entity.
     *
     * @Route("/new/{discriminator}", name="EvocatioPosBundle_ProductCreate")
     * @Method("POST")
     * @Template("WebsiteSiteBundle:Product:new.html.twig")
     */
    public function createAction($discriminator) {
        return parent::createAction($discriminator);
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_ProductUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("WebsiteSiteBundle:Product:edit.html.twig")
     */
    public function updateAction($id) {
        return parent::updateAction($id);
    }

}
