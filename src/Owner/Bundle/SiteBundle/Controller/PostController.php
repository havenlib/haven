<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Evocatio\Bundle\WebBundle\Controller\PostController as BasePostController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @Route("")
 */
class PostController extends BasePostController {

    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_post_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

}

?>
