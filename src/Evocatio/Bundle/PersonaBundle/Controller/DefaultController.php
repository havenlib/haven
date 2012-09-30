<?php

namespace Evocatio\Bundle\PersonaBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
use Evocatio\Bundle\PersonaBundle\Form\ContactType;
use Evocatio\Bundle\PersonaBundle\Entity\Contact;
use Evocatio\Bundle\PersonaBundle\Entity\ContactTranslation;
use Evocatio\Bundle\CoreBundle\Lib\Locale;

class DefaultController extends ContainerAware {

    /**
     * @Route("/test")
     * @template();
     */
    public function testAction() {
        return array();
    }

    /**
     * @Route("/", name="EvocatioPersonaBundle_index")
     * @Method("get")
     * @Template()
     */
    public function indexAction() {
        $contact = $this->container->get("Doctrine")->getRepository("EvocatioPersonaBundle:Contact")->findOnlines();

        return array("entities" => $contact);
    }

    /**
     * Finds and displays all contacts for admin.
     *
     * @Route("/list", name="EvocatioPersonaBundle_list")
     * @Method("get")
     * @Template()
     */
    public function listAction() {
        $contacts = $this->container->get("Doctrine")->getRepository("EvocatioPersonaBundle:Coordinate")->findAll();

        return array("entities" => $contacts);
    }

    /**
     * Finds and displays a contact entity.
     *
     * @Route("/{id}/show", name="EvocatioPersonaBundle_show")
     * @Method("get")
     * @Template()
     */
    public function showAction($id) {
        $contact = $this->container->get("Doctrine")->getRepository("EvocatioPersonaBundle:Contact")->findOneBy(array('id' => $id));

        if (!$contact) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $contact
        );
    }

    /**
     * @Route("/new", name="EvocatioPersonaBundle_new")
     * @Method("get")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->createEditForm(new \Evocatio\Bundle\PersonaBundle\Entity\Contact());

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new contact entity.
     *
     * @Route("/new", name="EvocatioPersonaBundle_create")
     * @Method("post")
     * @Template("EvocatioPersonaBundle:Contact:new.html.twig")
     */
    public function createAction() {
        $edit_form = $this->createEditForm(new \Evocatio\Bundle\PersonaBundle\Entity\Contact());

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("notice", "we were in !");

            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPersonaBundle_list'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        return array(
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPersonaBundle_edit")
     * @return RedirectResponse
     * @Method("get")
     * @Template
     */
    public function editAction($id) {
        $contact = $this->container->get("Doctrine")->getRepository("EvocatioPersonaBundle:Contact")->findOneEditables($id);

        if (!$contact) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($contact);
        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $contact,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPersonaBundle_update")
     * @return RedirectResponse
     * @Method("post")
     * @Template("EvocatioPersonaBundle:Default:edit.html.twig")
     */
    public function updateAction($id) {
        $contact = $this->container->get("Doctrine")->getRepository("EvocatioPersonaBundle:Contact")->findOneEditables($id);

        if (!$contact) {
            throw new NotFoundHttpException('entity.not.found');
        }

//        update the update time
        $contact->setUpdatedAt(new \DateTime());
        $edit_form = $this->createEditForm($contact);
        $delete_form = $this->createDeleteForm($id);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPersonaBundle_show', array('id' => $contact->getId())));
        }
        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'contact' => $contact,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Deletes a contact entity.
     *
     * @Route("/{id}/delete", name="EvocatioPersonaBundle_delete")
     * @Method("post")
     */
    public function deleteAction($id) {
        $delete_form = $this->createDeleteForm($id);
        $request = $this->container->get('Request');

        $delete_form->bindRequest($request);

        if ($delete_form->isValid()) {
            $em = $this->container->get('Doctrine')->getEntityManager();
            $contact = $em->getRepository("EvocatioPersonaBundle:Contact")->find($id);

            if (!$contact) {
                throw new NotFoundHttpException('entity.not.found');
            }

            $em->remove($contact);
            $em->flush();
        }

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPersonaBundle_list'));
    }

    /**
     * Set a contact entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioPersonaBundle_toggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $contact = $em->find('EvocatioPersonaBundle:Contact', $id);
        if (!$contact) {
            throw new NotFoundHttpException("Contact non trouvé");
        }
        $contact->setStatus(!$contact->getStatus());
        $em->persist($contact);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * @Route("/{slug}", name="EvocatioPersonaBundle_show_slug")
     * @Method("get")
     * @Template("EvocatioPersonaBundle:Default:show.html.twig")
     */
    public function showFromSlugAction(ContactTranslation $contactTranslation) {
//        $delete_form = $this->createDeleteForm($id);
        if ($contactTranslation->getTransLang()->getSymbol() != Locale::getPrimaryLanguage(Locale::getDefault())) {
            $slug = $contactTranslation->getParent()->getTranslationByLang(Locale::getPrimaryLanguage(Locale::getDefault()))->getSlug();
            return new RedirectResponse($this->container->get('router')->generate('EvocatioPersonaBundle_show_slug', array("slug" => $slug)));
        }
        $contact = $contactTranslation->getParent();

        if (!$contact) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($contact->getId());

        return array("entity" => $contact, 'delete_form' => $delete_form->createView()
        );
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param contact $contact
     * @return Form or RedirectResponse   if validation error
     */
    private function createEditForm($contact) {
//        the list of language here will decide what languages will appear in the form for new or edit.
        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(Array("status" => array(1, 2)));

//        $contact->addTranslations($languages);

        $edit_form = $this->container->get('form.factory')->create(new \Evocatio\Bundle\PersonaBundle\Form\ContactType(), $contact);
        return $edit_form;
    }

    /**
     *  Create the simple delete form
     * @param integer $id
     * @return form
     */
    private function createDeleteForm($id) {
        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $form
     * @return true or form
     */
    private function processForm($edit_form) {
        if ($edit_form->isValid()) {
            $em = $this->container->get('Doctrine')->getEntityManager();
            $entity = $edit_form->getData();

//            $uploader = $this->container->get("uploader");
//            $uploader->uploadTranslatableEntityFile($entity, "actualite");

            $em->persist($entity);
            $em->flush();

            return true;
        }

        return $edit_form;
    }

}
