<?php

namespace Website\Bundle\SiteBundle\Controller;

// Sensio includes
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class FaqController extends \Evocatio\Bundle\FaqBundle\Controller\FaqController {

    /**
     * Creates a new faq entity.
     *
     * @Route("/admin/faq/new", name="EvocatioFaqBundle_FaqCreate")
     * @Method("POST")
     * @Template("WebsiteSiteBundle:Faq:new.html.twig")
     */
    public function createAction() {
        return parent::createAction();
    }

    /**
     * @Route("/admin/faq/{id}/edit", name="EvocatioFaqBundle_FaqUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("WebsiteSiteBundle:Faq:edit.html.twig")
     */
    public function updateAction($id) {
        return parent::updateAction($id);
    }

}
