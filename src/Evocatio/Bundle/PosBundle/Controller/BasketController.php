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
use Evocatio\Bundle\PosBundle\Form\BasketType as Form;
use Evocatio\Bundle\PosBundle\Entity\Basket as Entity;

class BasketController extends ContainerAware {

    /**
     * @Route("/", name="EvocatioPosBundle_BasketIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entity = unserialize($this->container->get("session")->get("basket"));

        return array("entity" => $entity);
    }

    /**
     * Finds and displays a basket entity.
     *
     * @Route("/{id}/show", name="EvocatioPosBundle_BasketShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = unserialize($this->container->get("session")->get("basket"));

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * Finds and displays all baskets for admin.
     *
     * @Route("/list", name="EvocatioPosBundle_BasketList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entity = unserialize($this->container->get("session")->get("basket"));

        return array("entity" => $entity);
    }

    /**
     * @Route("/new", name="EvocatioPosBundle_BasketNew")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->createEditForm(new Entity());

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new basket entity.
     *
     * @Route("/new", name="EvocatioPosBundle_BasketCreate")
     * @Method("POST")
     * @Template("EvocatioPosBundle:Basket:new.html.twig")
     */
    public function createAction() {
        $edit_form = $this->createEditForm(new Entity());

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_BasketList'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        return array(
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Route("/edit", name="EvocatioPosBundle_BasketEdit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction() {
        $entity = unserialize($this->container->get("session")->get("basket"));
        foreach ($entity->getLineItems() as $line_item)
            $line_item->setProduct($this->container->get("doctrine")->getEntityManager()->merge($line_item->getProduct()));
        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }
        $edit_form = $this->createEditForm($entity);
//        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
//            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/edit", name="EvocatioPosBundle_BasketUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("EvocatioPosBundle:Basket:edit.html.twig")
     */
    public function updateAction() {
        $entity = unserialize($this->container->get("session")->get("basket"));
        foreach ($entity->getLineItems() as $line_item)
            $line_item->setProduct($this->container->get("doctrine")->getEntityManager()->merge($line_item->getProduct()));

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }
        $edit_form = $this->createEditForm($entity);
//        $delete_form = $this->createDeleteForm($id);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_BasketList'));
        }
        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
//            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Set a basket entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioPosBundle_BasketToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioPosBundle:Basket', $id);
        if (!$entity) {
            throw new NotFoundHttpException("Basket non trouvé");
        }
        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * Deletes a basket entity.
     *
     * @Route("/{id}/delete", name="EvocatioPosBundle_BasketDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $entity = $em->getRepository("EvocatioPosBundle:Basket")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($entity);
        $em->flush();

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_BasketList'));
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param basket $entity
     * @return Form or RedirectResponse   if validation error
     */
    protected function createEditForm($entity) {

        $edit_form = $this->container->get('form.factory')->create(new Form(), $entity);

        return $edit_form;
    }

    /**
     *  Create the simple delete form
     * @param integer $id
     * @return form
     */
    protected function createDeleteForm($id) {
        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $edit_form
     * @return true or form
     */
    protected function processForm($edit_form) {
        if ($edit_form->isValid()) {
            $entity = $edit_form->getData();
            $this->container->get("session")->set("basket",  serialize($entity));

            return true;
        }

        return $edit_form;
    }

}
