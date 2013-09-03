<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Haven\Bundle\PersonaBundle\Controller\PersonaController;

/**
 * @Route("", requirements={
 *      "rank" = "rank|ordonner"
 *    , "persona" = "employee|employe"
 *    , "theteam" = "the-team|l-equipe"
 * })
 */
class EmployeeController extends PersonaController {

    protected $ROUTE_PREFIX = "owner_site_employee";
    protected $PERSONA = "employee";

    /**
     * @Route("/{theteam}")
     * 
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get($this->PERSONA . ".read_handler")->getAll();

        return array("entities" => $entities);
    }

    /**
     * @Route("/{theteam}/{slug}")
     * 
     * @Method("GET")
     * @Template()
     */
    public function displayAction($slug) {
        $entity = $this->container->get($this->PERSONA . ".read_handler")->getOneBySlug($slug);

        return array("entity" => $entity);
    }

    /**
     * @Route("/admin/{create}/persona/{persona}")
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $edit_form = $this->container->get($this->PERSONA . ".form_handler")->createNewForm();
        echo $edit_form->getName();

        $request = $this->container->get('request_modifier')->setRequest($this->container->get("Request"))
                ->slug(array("firstname", "lastname"))
                ->getRequest();

        $edit_form->bind($request);


        if ($edit_form->isValid()) {
            $this->container->get($this->PERSONA . ".persistence_handler")->save($persona = $edit_form->getData());

//            $this->forward('OwnerSiteBundle:User:createReset', array('user' => $persona->getUser()));
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
