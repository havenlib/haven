<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Evocatio\Bundle\PersonaBundle\Controller\PersonaController;

/**
 * @Route("", requirements={
 *      "rank" = "rank|ordonner"
 *    , "persona" = "employee|employe"
 * })
 */
class EmployeeController extends PersonaController {

    protected $ROUTE_PREFIX = "owner_site_employee";
    protected $PERSONA = "employee";

}

?>
