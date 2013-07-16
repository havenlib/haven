<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AdminController extends ContainerAware {

    /**
     * @Route("/admin")
     * @Method("GET")
     * @Template
     */
    public function indexAction() {
        return array();
    }

}

?>
