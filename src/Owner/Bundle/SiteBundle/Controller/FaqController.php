<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Evocatio\Bundle\WebBundle\Controller\FaqController as BaseFaqController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class FaqController extends BaseFaqController {

    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_faq_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

}

?>
