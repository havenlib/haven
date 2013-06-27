<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Evocatio\Bundle\WebBundle\Controller\PostController as BasePostController;

/**
 * @Route("", requirements={
 *        "displayrandom" = "display-random|afficher-aleatoire"
 * })
 */
class PostController extends BasePostController {

    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_post_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

    /**
     * 
     * @Route("/{displayrandom}/post")
     * @Method("GET")
     * @Template
     */
    public function displayRandomAction() {
        $entity = $this->container->get('post.read_handler')->getOneRandomPublished();
   
        return array("entity" => $entity);
    }

    /**
     * 
     * @Route("/{displaylastpublished}/post")
     * @Method("GET")
     * @Template
     */
    public function displayLastPublishedAction($limit = null) {
        $entities = $this->container->get('post.read_handler')->getLastPublished($limit);
   
        return array("entities" => $entities);
    }

}

?>
