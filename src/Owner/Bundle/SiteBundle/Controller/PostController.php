<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Haven\Bundle\WebBundle\Controller\PostController as BasePostController;

/**
 * @Route("", requirements={
 *        "displayrandom" = "display-random|afficher-aleatoire"
 *      , "rank" = "rank|ordonner"
 * })
 */
class PostController extends BasePostController {

    protected $ROUTE_PREFIX = "owner_site";

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
