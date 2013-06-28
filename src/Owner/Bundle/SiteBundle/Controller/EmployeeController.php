<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Evocatio\Bundle\PersonaBundle\Controller\PersonaController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("", requirements={
 *      "rank" = "rank|ordonner"
 *    , "persona" = "employee|employe"
 * })
 */
class EmployeeController extends PersonaController {

    protected $ROUTE_PREFIX = "owner_site_employee";
    protected $PERSONA = "employee";

    /**
     * @Route("/admin/{create}/persona/{persona}")
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $edit_form = $this->container->get($this->PERSONA . ".form_handler")->createNewForm();
        $edit_form->bind($this->container->get('Request'));


        if ($edit_form->isValid()) {
            $this->container->get($this->PERSONA . ".persistence_handler")->save($persona = $edit_form->getData());

            $this->forward('OwnerSiteBundle:User:createReset', array('user' => $persona->getUser()));
            $this->container->get("session")->getFlashBag()->add("success", "create.success");

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_list', $this->PERSONA, array(), array('list')));
        }

        $this->container->get("session")->getFlashBag()->add("error", "create.error");

        $template = str_replace(":create.html.twig", ":new.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    public function forward($controller, array $path = array(), array $query = array()) {
        $path['_controller'] = $controller;
        $subRequest = $this->container->get('request')->duplicate($query, null, $path);

        return $this->container->get('http_kernel')->handle($subRequest, \Symfony\Component\HttpKernel\HttpKernelInterface::SUB_REQUEST);
    }

}

?>
