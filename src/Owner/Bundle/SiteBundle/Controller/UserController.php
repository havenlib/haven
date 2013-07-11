<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Evocatio\Bundle\SecurityBundle\Controller\UserController as BaseUserController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("", requirements={
 *        "user" = "user|utilisateur"
 *      , "password" = "password|mot-de-passe"
 *      , "initialize" = "initialize|initialiser"
 *      , "reset" = "reset|reinitialiser"
 * })
 */
class UserController extends BaseUserController {

    protected $ROUTE_PREFIX = "owner_site";

}
