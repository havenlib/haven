<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Evocatio\Bundle\WebBundle\Controller\FaqController as BaseFaqController;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("", requirements={
 *      "rank" = "rank|ordonner"
 * })
 */
class FaqController extends BaseFaqController {

    protected $ROUTE_PREFIX = "owner_site";

}

?>
