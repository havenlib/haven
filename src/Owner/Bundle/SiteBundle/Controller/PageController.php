<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Evocatio\Bundle\CmsBundle\Controller\PageController as BasePageController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageController extends BasePageController {

    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_page_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

}

?>
