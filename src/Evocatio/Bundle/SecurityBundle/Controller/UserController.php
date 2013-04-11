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


//use Evocatio\Bundle\SecurityBundle\Form\LoginType;

class UserController extends ContainerAware {

    /**
     * @Route("/user/", name="EvocatioSecurityBundle_UserIndex")
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
     * @Route("/user/{id}/show", name="EvocatioSecurityBundle_UserShow")
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
     * @Route("/admin/user/list", name="EvocatioSecurityBundle_UserList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("user.read_handler")->getAll();
        return array("entities" => $entities);
    }

    /**
     * @Route("/admin/user/new", name="EvocatioSecurityBundle_UserNew")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->container->get("user.form_handler")->createNewForm();
        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/admin/user/new", name="EvocatioSecurityBundle_UserCreate")
     * @Method("POST")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get("user.form_handler")->createNewForm();
        $edit_form->bindRequest($this->container->get('Request'));


        if ($edit_form->isValid()) {
            $this->container->get("user.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioSecurityBundle_UserList'));
        }

        $this->container->get("session")->setFlash("error", "create.error");

        $template = str_replace(":create.html.twig", ":new.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/admin/user/{id}/edit", name="EvocatioSecurityBundle_UserEdit")
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
     * @Route("/admin/user/{id}/edit", name="EvocatioSecurityBundle_UserUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $entity = $this->container->get('user.read_handler')->get($id);
        $edit_form = $this->container->get("user.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("user.form_handler")->createDeleteForm($entity->getId());


        $edit_form->bindRequest($this->container->get('Request'));
        if (!$edit_form->isValid()) {
            $this->container->get("user.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioSecurityBundle_FaqList'));
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

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param user $entity
     * @return Form or RedirectResponse   if validation error
     */
//    protected function createEditForm($entity) {
//
//        $edit_form = $this->container->get('form.factory')->create(new Form(), $entity);
//        return $edit_form;
//    }
//
//    /**
//     *  Create the simple delete form
//     * @param integer $id
//     * @return form
//     */
//    protected function createDeleteForm($id) {
//        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
//                        ->add('id', 'hidden')
//                        ->getForm()
//        ;
//    }
//
//    /**
//     * Validate and save form, if invalid returns form
//     * @param type $edit_form
//     * @return true or form
//     */
//    protected function processForm($edit_form) {
//        if ($edit_form->isValid()) {
//            $em = $this->container->get('Doctrine')->getEntityManager();
//            $entity = $edit_form->getData();
//            if (0 !== strlen($password = $entity->getPlainPassword())) {
//                $factory = $this->container->get('security.encoder_factory');
//                $encoder = $factory->getEncoder($entity);
//                $entity->setPassword($encoder->encodePassword($password, $entity->getSalt()));
//            }
//            $em->persist($entity);
//            $em->flush();
//
//            return true;
//        }
//
//        return $edit_form;
//    }

}