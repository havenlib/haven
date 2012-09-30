<?php

namespace Evocatio\Bundle\FaqBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
use Evocatio\Bundle\FaqBundle\Form\FaqType;
use Evocatio\Bundle\FaqBundle\Entity\Faq;

class DefaultController extends ContainerAware {

    /**
     * @Route("/", name="EvocatioFaqBundle_index")
     * @Method("get")
     * @Template()
     */
    public function indexAction() {
        $faqs = $this->container->get("Doctrine")->getRepository("EvocatioFaqBundle:Faq")->findOnlines();

        return array("entities" => $faqs);
    }

    /**
     * Finds and displays all faqs for admin.
     *
     * @Route("/list", name="EvocatioFaqBundle_list")
     * @Method("get")
     * @Template()
     */
    public function listAction() {
        $faqs = $this->container->get("Doctrine")->getRepository("EvocatioFaqBundle:Faq")->findAll();

        return array("entities" => $faqs);
    }

    /**
     * @Route("/new", name="EvocatioFaqBundle_new")
     * @Method("get")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->createEditForm(new Faq());

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new faq entity.
     *
     * @Route("/new", name="EvocatioFaqBundle_create")
     * @Method("post")
     * @Template("EvocatioFaqBundle:Faq:new.html.twig")
     */
    public function createAction() {
        $edit_form = $this->createEditForm(new Faq());

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioFaqBundle_list'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        return array(
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioFaqBundle_edit")
     * @return RedirectResponse
     * @Method("get")
     * @Template
     */
    public function editAction($id) {
        $faq = $this->container->get("Doctrine")->getRepository("EvocatioFaqBundle:Faq")->findOneEditables($id);

        if (!$faq) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($faq);
        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $faq,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioFaqBundle_update")
     * @return RedirectResponse
     * @Method("post")
     * @Template("EvocatioFaqBundle:Default:edit.html.twig")
     */
    public function updateAction($id) {
        $faq = $this->container->get("Doctrine")->getRepository("EvocatioFaqBundle:Faq")->findOneEditables($id);

        if (!$faq) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($faq);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioFaqBundle_list'));
        }
        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'entity' => $faq,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Set a faq entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioFaqBundle_toggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $faq = $em->find('EvocatioFaqBundle:Faq', $id);
        if (!$faq) {
            throw new NotFoundHttpException("Faq non trouvé");
        }
        $faq->setStatus(!$faq->getStatus());
        $em->persist($faq);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * Deletes a faq entity.
     *
     * @Route("/{id}/delete", name="EvocatioFaqBundle_delete")
     * @Method("GET")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $faq = $em->getRepository("EvocatioFaqBundle:Faq")->find($id);

        if (!$faq) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($faq);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param faq $faq
     * @return Form or RedirectResponse   if validation error
     */
    protected function createEditForm($faq) {
//        the list of language here will decide what languages will appear in the form for new or edit.
        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(Array("status" => array(1, 2)));

        $faq->addTranslations($languages);

        $edit_form = $this->container->get('form.factory')->create(new FaqType(), $faq);
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
