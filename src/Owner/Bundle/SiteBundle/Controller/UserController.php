<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Evocatio\Bundle\SecurityBundle\Controller\UserController as BaseUserController;

class UserController extends BaseUserController {

    protected $ROUTE_PREFIX = "owner_site";

}
