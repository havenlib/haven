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

abstract class PersonaController extends ContainerAware {

    /**
     * @Route("/{discriminator}")
     * 
     * @Method("GET")
     * @Template()
     */
    public function indexAction($discriminator) {
        if (!$this->container->has($discriminator . ".read_handler"))
            throw new \Exception($discriminator . ".read_handler doesn't exist or isn't setted in service.yml");

        $entities = $this->container->get($discriminator . ".read_handler")->getAll();

        return array("entities" => $entities);
    }

    /**
     * Finds and all persona for admin.
     *
     * @Route("{admin}/list/{discriminator}", requirements={"admin" = "admin"}, defaults={"admin" = "admin"})
     * @Method("GET")
     * @Template()
     */
    public function listAction($discriminator) {
        if (!$this->container->has($discriminator . ".read_handler"))
            throw new \Exception($discriminator . ".read_handler doesn't exist or isn't setted in service.yml");

        $entities = $this->container->get($discriminator . ".read_handler")->getAll();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/{admin}/show/{discriminator}/{id}", requirements={"admin" = "admin"}, defaults={"admin" = "admin"})
     * 
     * @Method("GET")
     * @Template()
     */
    public function showAction($id, $discriminator) {
        if (!$this->container->has($discriminator . ".read_handler"))
            throw new \Exception($discriminator . ".read_handler doesn't exist or isn't setted in service.yml");

        if (!$this->container->has($discriminator . ".form_handler"))
            throw new \Exception($discriminator . ".form_handler doesn't exist or isn't setted in service.yml");


        $entity = $this->container->get($discriminator . ".read_handler")->get($id);
        $delete_form = $this->container->get($discriminator . ".form_handler")->createDeleteForm($id);

        return array(
            'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * @Route("/{admin}/new/{discriminator}", requirements={"admin" = "admin"} , defaults={"admin" = "admin"})
     * 
     * @Method("GET")
     * @Template
     */
    public function newAction($discriminator) {
        if (!$this->container->has($discriminator . ".form_handler"))
            throw new \Exception($discriminator . ".form_handler doesn't exist or isn't setted in service.yml");

        $edit_form = $this->container->get($discriminator . ".form_handler")->createNewForm();

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new persona entity.
     *
     * @Route("/{admin}/new/{discriminator}", requirements={"admin" = "admin"}, defaults={"admin" = "admin"})
     * 
     * @Method("POST")
     * @Template
     */
    public function createAction($discriminator) {
        if (!$this->container->has($discriminator . ".form_handler"))
            throw new \Exception($discriminator . ".form_handler doesn't exist or isn't setted in service.yml");

        $edit_form = $this->container->get($discriminator . ".form_handler")->createNewForm();
        $edit_form->bindRequest($this->container->get('Request'));


        if ($edit_form->isValid()) {
            if (!$this->container->has($discriminator . ".persistence_handler"))
                throw new \Exception($discriminator . ".persistence_handler doesn't exist or isn't setted in service.yml");

            $this->container->get($discriminator . ".persistence_handler")->save($edit_form->getData());

            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('evocatio_persona_' . $discriminator . '_list', array("discriminator" => $discriminator)));
        }

        $this->container->get("session")->setFlash("error", "create.error");

        $template = str_replace(":create.html.twig", ":new.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/{admin}/edit/{discriminator}/{id}", requirements={"admin" = "admin"}, defaults={"admin" = "admin"})
     * 
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id, $discriminator) {
        if (!$this->container->has($discriminator . ".read_handler"))
            throw new \Exception($discriminator . ".read_handler doesn't exist or isn't setted in service.yml");

        if (!$this->container->has($discriminator . ".form_handler"))
            throw new \Exception($discriminator . ".form_handler doesn't exist or isn't setted in service.yml");

        $entity = $this->container->get($discriminator . ".read_handler")->get($id);
        $delete_form = $this->container->get($discriminator . ".form_handler")->createDeleteForm($id);
        $edit_form = $this->container->get($discriminator . ".form_handler")->createEditForm($id);

        return array(
            'edit_form' => $edit_form->createView()
            , 'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * @Route("/{admin}/edit/{discriminator}/{id}", requirements={"admin" = "admin"}, defaults={"admin" = "admin"})
     * 
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id, $discriminator) {
        if (!$this->container->has($discriminator . ".read_handler"))
            throw new \Exception($discriminator . ".read_handler doesn't exist or isn't setted in service.yml");

        if (!$this->container->has($discriminator . ".form_handler"))
            throw new \Exception($discriminator . ".form_handler doesn't exist or isn't setted in service.yml");

        $entity = $this->container->get($discriminator . ".read_handler")->get($id);
        $delete_form = $this->container->get($discriminator . ".form_handler")->createDeleteForm($id);
        $edit_form = $this->container->get($discriminator . ".form_handler")->createEditForm($id);


        $edit_form->bindRequest($this->container->get('Request'));
        if ($edit_form->isValid()) {
            if (!$this->container->has($discriminator . ".persistence_handler"))
                throw new \Exception($discriminator . ".persistence_handler doesn't exist or isn't setted in service.yml");

            $this->container->get($discriminator . ".persistence_handler")->save($edit_form->getData());

            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('evocatio_persona_' . $discriminator . '_list', array("discriminator" => $discriminator)));
        }

        $this->container->get("session")->setFlash("error", "update.error");

        $template = str_replace(":update.html.twig", ":edit.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

}

?>
