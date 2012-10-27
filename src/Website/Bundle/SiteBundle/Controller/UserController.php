<?php

namespace Website\Bundle\SiteBundle\Controller;

// Sensio includes
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


class UserController extends \Evocatio\Bundle\SecurityBundle\Controller\UserController {

    /**
     * Creates a new faq entity.
     *
     * @Route("/new", name="EvocatioSecurityBundle_UserCreate")
     * @Method("POST")
     * @Template("WebsiteSiteBundle:User:new.html.twig")
     */
    public function createAction() {
        return parent::createAction();
    }

    /**
     * @Route("/{id}/edit", name="EvocatioSecurityBundle_UserUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("WebsiteSiteBundle:User:edit.html.twig")
     */
    public function updateAction($id) {
        return parent::updateAction($id);
    }

}
