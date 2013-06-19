<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Evocatio\Bundle\WebBundle\Controller\FaqController as BaseFaqController;

class FaqController extends BaseFaqController {

    protected function redirectCreateAction() {
        return $this->redirectAction('owner_site_faq', 'create');
    }

    protected function redirectListAction() {
        return $this->redirectAction('owner_site_faq', 'list');
    }

}

?>
