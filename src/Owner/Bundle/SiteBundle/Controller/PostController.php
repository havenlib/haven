<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Evocatio\Bundle\WebBundle\Controller\PostController as BasePostController;

/**
 * @Route("")
 */
class PostController extends BasePostController {

    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_post_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

    /**
     * Creates a new post entity.
     *
     * @Route("/random/post")
     * @Method("GET")
     * @Template
     */
    public function showRandomAction() {
        $entity = $this->container->get('post.read_handler')->getOneRandomPublished();
        
   
        return array("entity" => $entity);
    }

}

?>
