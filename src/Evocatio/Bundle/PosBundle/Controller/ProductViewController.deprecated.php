<?php

namespace Evocatio\Bundle\PosBundle\Controller;

// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Envocatio Include
use Evocatio\Bundle\CoreBundle\Controller\JoinedViewController;
use Evocatio\Bundle\PosBundle\Entity\Product as Entity;

class ProductViewController extends JoinedViewController {

    public function __construct() {
        $this->base_class = new Entity();
    }
    
    /**
     * @Route("/", name="EvocatioPosBundle_ProductIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        return parent::indexAction();
    }
 
    
    /**
     *
     * @Route("/{id}/show", name="EvocatioPosBundle_ProductShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        return parent::showAction($id);
    }

}
