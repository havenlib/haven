<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
// Sensio includes
use Evocatio\Bundle\CmsBundle\Controller\TemplateController as BaseTemplateController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TemplateController extends BaseTemplateController {

    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_template_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

    protected function redirectEditAction($id) {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_template_edit', array(
                    'edit' => $this->container->get('translator')->trans("edit", array(), "routes")
                    , 'id' => $id)));
    }

}

?>
