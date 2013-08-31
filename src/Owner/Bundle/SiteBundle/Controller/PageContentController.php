<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Haven\Bundle\CmsBundle\Controller\PageContentController as BasePageContentController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageContentController extends BasePageContentController {

    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_pagecontent_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

    protected function redirectEditAction($id) {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_pagecontent_edit', array(
                    'edit' => $this->container->get('translator')->trans("edit", array(), "routes")
                    , 'id' => $id)));
    }

}

?>
