<?php

namespace Evocatio\Bundle\PosBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
use \Evocatio\Bundle\CoreBundle\Controller\JoinedAdminController;
use Evocatio\Bundle\PosBundle\Entity\Product as Entity;

class ProductAdminController extends JoinedAdminController {

    public function __construct() {
        $this->base_class = new Entity();
    }

}
