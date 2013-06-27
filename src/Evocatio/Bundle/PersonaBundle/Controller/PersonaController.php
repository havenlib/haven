<?php

namespace Evocatio\Bundle\PersonaBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PersonaController extends ContainerAware {

    protected $PERSONA = null;

    /**
     * @Route("/persona/{persona}")
     * 
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get($this->PERSONA . ".read_handler")->getAll();

        return array("entities" => $entities);
    }

    /**
     * Finds and all persona for admin.
     *
     * @Route("/admin/{list}/persona/{persona}")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get($this->PERSONA . ".read_handler")->getAll();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/admin/{show}/{persona}/{id}", requirements={"admin" = "admin"})
     * 
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get($this->PERSONA . ".read_handler")->get($id);
        $delete_form = $this->container->get($this->PERSONA . ".form_handler")->createDeleteForm($id);

        return array(
            'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * @Route("/admin/{create}/persona/{persona}")
     * 
     * @Method("GET")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get($this->PERSONA . ".form_handler")->createNewForm();

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new persona entity.
     *
     * @Route("/admin/{create}/persona/{persona}")
     * 
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $edit_form = $this->container->get($this->PERSONA . ".form_handler")->createNewForm();
        $edit_form->bind($this->container->get('Request'));


        if ($edit_form->isValid()) {
            $this->container->get($this->PERSONA . ".persistence_handler")->save($edit_form->getData());

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

    /**
     * @Route("/admin/{edit}/{persona}/{id}")
     * 
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get($this->PERSONA . ".read_handler")->get($id);
        $delete_form = $this->container->get($this->PERSONA . ".form_handler")->createDeleteForm($id);
        $edit_form = $this->container->get($this->PERSONA . ".form_handler")->createEditForm($id);

        return array(
            'edit_form' => $edit_form->createView()
            , 'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * @Route("/admin/{edit}/{persona}/{id}")
     * 
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $entity = $this->container->get($this->PERSONA . ".read_handler")->get($id);
        $delete_form = $this->container->get($this->PERSONA . ".form_handler")->createDeleteForm($id);
        $edit_form = $this->container->get($this->PERSONA . ".form_handler")->createEditForm($id);


        $edit_form->bind($this->container->get('Request'));
        if ($edit_form->isValid()) {
            $this->container->get($this->PERSONA . ".persistence_handler")->save($edit_form->getData());

            $this->container->get("session")->getFlashBag()->add("success", "update.success");
            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_list', $this->PERSONA, array(), array('list')));
        }

        $this->container->get("session")->getFlashBag()->add("error", "update.error");

        $template = str_replace(":update.html.twig", ":edit.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    protected function generateI18nRoute($route, $persona, $parameters = array(), $translate = array(), $lang = null, $absolute = false) {
        foreach ($translate as $word) {
            $parameters[$word] = $this->container->get('translator')->trans($word, array(), "routes", $lang);
        }
        $parameters['persona'] = $this->container->get('translator')->trans($persona, array(), "routes", $lang);
        return $this->container->get('router')->generate($route, $parameters, $absolute);
    }

}

?>
