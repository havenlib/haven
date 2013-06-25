<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Evocatio\Bundle\SecurityBundle\Controller\UserController as BaseUserController;

class UserController extends BaseUserController {

    protected function redirectListAction() {
        return $this->redirectAction('owner_site_user_list', array(), array('user', 'list'));
    }
}
