<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Evocatio\Bundle\CmsBundle\Controller\MenuController as BaseMenuController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("", requirements={
 *      "rank" = "rank|ordonner"
 * })
 */
class MenuController extends BaseMenuController {

    protected $ROUTE_PREFIX = "owner_site";

}

?>
