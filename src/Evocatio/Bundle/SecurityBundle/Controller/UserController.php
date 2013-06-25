<?php

namespace Evocatio\Bundle\SecurityBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Evocatio includes

class UserController extends ContainerAware {

    /**
     * @Route("/{user}")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("user.read_handler")->getAll();
        return array("entities" => $entities);
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/{show}/{user}/{id}")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("user.read_handler")->get($id);
        $delete_form = $this->container->get("user.form_handler")->createDeleteForm($id);

        return array(
            'entity' => $entity,
            "delete_form" => $delete_form->createView()
        );
    }

    /**
     * Finds and displays all users for admin.
     *
     * @Route("/admin/{list}/{user}")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("user.read_handler")->getAll();
        return array("entities" => $entities);
    }

    /**
     * @Route("/admin/{create}/{user}")
     * @Method("GET")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get("user.form_handler")->createNewForm();
        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/admin/{create}/{user}")
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $edit_form = $this->container->get("user.form_handler")->createNewForm();
        $edit_form->bind($this->container->get('request'));


        if ($edit_form->isValid()) {
            $reset = $this->container->get("user.persistence_handler")->saveWithReset($edit_form->getData());

            $notifier = $this->container->get('notifier');
            $notifier->createNewUserNotification($reset);
//            $notifier->send();
//            $this->container->get("session")->getFlashBag()->add("success", "create.success");
//            return $this->redirectListAction();
        }

        $this->container->get("session")->getFlashBag()->add("error", "create.error");

        $template = str_replace(":add.html.twig", ":create.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/admin/{edit}/{user}/{id}")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get('user.read_handler')->get($id);
        $edit_form = $this->container->get("user.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("user.form_handler")->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/admin/{edit}/{user}/{id}")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $entity = $this->container->get('user.read_handler')->get($id);
        $edit_form = $this->container->get("user.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("user.form_handler")->createDeleteForm($entity->getId());


        $edit_form->bind($this->container->get('Request'));
        if ($edit_form->isValid()) {
            $this->container->get("user.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->getFlashBag()->add("success", "create.success");

            return $this->redirectListAction();
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

    /**
     * Set a user entity state to inactive.
     *
     * @Route("/admin/user/{id}/state", name="EvocatioSecurityBundle_toggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioSecurityBundle:User', $id);
        if (!$entity) {
            throw new NotFoundHttpException("User non trouvé");
        }
        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/admin/user/{id}/delete", name="EvocatioSecurityBundle_delete")
     * @Method("POST")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $entity = $em->getRepository("EvocatioSecurityBundle:User")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($entity);
        $em->flush();

        return new RedirectResponse($this->container->get('router')->generate('EvocatioSecurityBundle_UserList'));
    }

    protected function redirectListAction() {
        return $this->redirectAction('evocatio_security_user_list', array(), array('user', 'list'));
    }

    protected function redirectAction($route, $parameters = array(), $translate = array()) {
        foreach ($translate as $word) {
            $parameters[$word] = $this->container->get('translator')->trans($word, array(), "routes");
        }

        return new RedirectResponse($this->container->get('router')->generate($route, $parameters));
    }

}