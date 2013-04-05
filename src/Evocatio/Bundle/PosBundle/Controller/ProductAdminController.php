<?php

namespace Evocatio\Bundle\PosBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
use \Evocatio\Bundle\CoreBundle\Controller\JoinedAdminController;
use Evocatio\Bundle\PosBundle\Entity\Product as Entity;

class ProductAdminController extends JoinedAdminController {

    public function __construct() {
        $this->base_class = new Entity();
    }

    /**
     * Finds and displays all products for admin.
     *
     * @Route("/list", name="EvocatioPosBundle_ProductList")
     * @Method("GET")
     * @Template
     */
    public function listAction() {
        return parent::listAction();
    }

    /**
     * @Route("/new/{discriminator}", name="EvocatioPosBundle_ProductNew")
     * @Method("GET")
     * @Template
     */
    public function newAction($discriminator) {
        return parent::newAction($discriminator);
    }

    /**
     * Creates a new joined entity.
     *
     * @Route("/new/{discriminator}", name="EvocatioPosBundle_ProductCreate")
     * @Method("POST")
     * @Template
     */
    public function createAction($discriminator) {
        return parent::createAction($discriminator);
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_ProductEdit")
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        return parent::editAction($id);
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_ProductUpdate")
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        return parent::updateAction($id);
    }

    /**
     *
     * @Route("/choose-discriminator", name="EvocatioPosBundle_ProductChooseDiscriminator")
     * @Method("GET")
     * @Template
     */
    public function chooseDiscriminatorAction() {
        return parent::chooseDiscriminatorAction();
    }

    /**
     * Deletes a persona entity.
     *
     * @Route("/{id}/delete", name="EvocatioPosBundle_ProductDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {
        return parent::deleteAction($id);
    }

}
