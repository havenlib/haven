<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Haven\Bundle\CmsBundle\Controller\MenuController as BaseMenuController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("", requirements={
 *      "rank" = "rank|ordonner"
 * })
 */
class MenuController extends BaseMenuController {

    protected $ROUTE_PREFIX = "owner_site";

    public function displayMenuAction($id) {
        $entities = $this->container->get('menu.read_handler')->getBranch($id);

        return array("entities" => $entities);
    }
}
