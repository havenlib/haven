<?php

namespace Evocatio\Bundle\PersonaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PersonController extends PersonaController {

    /**
     * @Route("/{admin}/new/person/with-coordinate", requirements={"admin" = "admin"} , defaults={"admin" = "admin"})
     * 
     * @Method("GET")
     * @Template
     */
    public function newWithCoordinateAction() {
        $edit_form = $this->container->get("person.form_handler")->createNewWithCoordinateForm();

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * @Route("/{admin}/new/person/with-coordinate", requirements={"admin" = "admin"} , defaults={"admin" = "admin"})
     * 
     * @Method("POST")
     * @Template
     */
    public function createWithCoordinateAction() {
        $edit_form = $this->container->get("person.form_handler")->createNewForm();
        $edit_form->bindRequest($this->container->get('Request'));


        if ($edit_form->isValid()) {
            $this->container->get("person.persistence_handler")->save($edit_form->getData());

            $this->container->get("session")->getFlashBag()->add("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('evocatio_persona_person_list', array("persona" => 'person', 'list', 'list')));
        }

        $this->container->get("session")->getFlashBag()->add("error", "create.error");

        $template = str_replace(":create.html.twig", ":new.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

}
