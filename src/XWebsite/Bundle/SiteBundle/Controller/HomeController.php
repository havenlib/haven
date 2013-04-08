<?php

namespace Website\Bundle\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\DependencyInjection\ContainerAware;

class HomeController extends ContainerAware
{
    /**
     * @Route("/", name="WebsiteSiteBundle_Home")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => 'Hooo');
    }
}
