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
use Evocatio\Bundle\PosBundle\Form\GenericProductType as Form;
use Evocatio\Bundle\PosBundle\Entity\GenericProduct as Entity;

class GenericProductController extends ContainerAware {

    /**
     * @Route("/", name="EvocatioPosBundle_GenericProductIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:GenericProduct")->findAll();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays an entity.
     *
     * @Route("/{id}/show", name="EvocatioPosBundle_GenericProductShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:GenericProduct")->find($id);

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
     * Finds and displays all entities for admin.
     *
     * @Route("/list", name="EvocatioPosBundle_GenericProductList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:GenericProduct")->findAll();
//        echo "default : " .\Evocatio\Bundle\CoreBundle\Lib\Locale::getDefault();
        return array("entities" => $entities);
    }

    /**
     * @Route("/new", name="EvocatioPosBundle_GenericProductNew")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->createEditForm(new Entity());

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new entity.
     *
     * @Route("/new", name="EvocatioPosBundle_GenericProductCreate")
     * @Method("POST")
     * @Template("EvocatioPosBundle:Default:new.html.twig")
     */
    public function createAction() {
        $edit_form = $this->createEditForm(new Entity());

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_GenericProductList'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        return array(
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_GenericProductEdit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:GenericProduct")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }
        $edit_form = $this->createEditForm($entity);
        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_GenericProductUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("EvocatioPosBundle:Default:edit.html.twig")
     */
    public function updateAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:GenericProduct")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($entity);
        $delete_form = $this->createDeleteForm($id);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_GenericProductList'));
        }
        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Set an entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioPosBundle_GenericProductToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioPosBundle:GenericProduct', $id);
        if (!$entity) {
            throw new NotFoundHttpException("GenericProduct non trouvé");
        }
        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * Deletes a entity.
     *
     * @Route("/{id}/delete", name="EvocatioPosBundle_GenericProductDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $entity = $em->getRepository("EvocatioPosBundle:GenericProduct")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($entity);
        $em->flush();

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_GenericProductList'));
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param $entity
     * @return Form or RedirectResponse   if validation error
     */
    protected function createEditForm($entity) {
//        the list of language here will decide what languages will appear in the form for new or edit.
        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(Array("status" => array(1, 2)));

        $entity->addTranslations($languages);

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
            $em = $this->container->get('Doctrine')->getEntityManager();
            $entity = $edit_form->getData();
            $em->persist($entity);
            $em->flush();

            return true;
        }

        return $edit_form;
    }

}
