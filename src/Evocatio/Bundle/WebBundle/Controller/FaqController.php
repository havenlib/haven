<?php

namespace Evocatio\Bundle\WebBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

// Evocatio includes
use Evocatio\Bundle\WebBundle\Form\FaqType as Form;

class FaqController extends ContainerAware {

    /**
     * @Route("/faq/", name="EvocatioWebBundle_FaqIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("faq.read_handler")->getAllPublished();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/admin/faq/{id}/show", name="EvocatioWebBundle_FaqShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("faq.read_handler")->get($id);
        $delete_form = $this->container->get("faq.form_handler")->createDeleteForm($id);

        return array(
            'entity' => $entity,
            "delete_form" => $delete_form->createView()
        );
    }

    /**
     * Finds and displays all faqs for admin.
     *
     * @Route("/admin/faq/list", name="EvocatioWebBundle_FaqList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("faq.read_handler")->getAllPublished();
        return array("entities" => $entities);
    }

    /**
     * @Route("/admin/faq/new", name="EvocatioWebBundle_FaqNew")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->container->get("faq.form_handler")->createNewForm();
        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new faq entity.
     *
     * @Route("/admin/faq/new", name="EvocatioWebBundle_FaqCreate")
     * @Method("POST")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get("faq.form_handler")->createNewForm();

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioWebBundle_FaqList'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        
        $template = str_replace(":create.html.twig", ":new.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/admin/faq/{id}/edit", name="EvocatioWebBundle_FaqEdit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get('faq.read_handler')->get($id);
        $edit_form = $this->container->get("faq.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("faq.form_handler")->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/admin/faq/{id}/edit", name="EvocatioWebBundle_FaqUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioWebBundle:Faq")->findOneEditables($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($entity);
        $delete_form = $this->createDeleteForm($id);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioWebBundle_FaqList'));
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
     * Set a faq entity state to inactive.
     *
     * @Route("/admin/faq/{id}/state", name="EvocatioWebBundle_FaqToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioWebBundle:Faq', $id);
        if (!$entity) {
            throw new NotFoundHttpException("Faq non trouvé");
        }
        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * Deletes a faq entity.
     *
     * @Route("/admin/faq/{id}/delete", name="EvocatioWebBundle_FaqDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $entity = $em->getRepository("EvocatioWebBundle:Faq")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($entity);
        $em->flush();

        return new RedirectResponse($this->container->get('router')->generate('EvocatioWebBundle_FaqList'));
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param faq $entity
     * @return Form or RedirectResponse   if validation error
     */
    protected function createEditForm($entity) {
//        the list of language here will decide what languages will appear in the form for new or edit.
        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findOnlinesByRank();

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
