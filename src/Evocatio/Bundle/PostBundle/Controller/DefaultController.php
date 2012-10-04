<?php

namespace Evocatio\Bundle\PostBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
use Evocatio\Bundle\PostBundle\Form\PostType as Form;
use Evocatio\Bundle\PostBundle\Entity\Post as Entity;
use Evocatio\Bundle\PostBundle\Entity\PostTranslation as EntityTranslation;

class DefaultController extends ContainerAware {

    /**
     * @Route("/", name="EvocatioPostBundle_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findOnlines();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/{id}/show", name="EvocatioPostBundle_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findOneBy(array('id' => $id));

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
     * Finds and displays all posts for admin.
     *
     * @Route("/list", name="EvocatioPostBundle_list")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findAll();
//        echo "default : " .\Evocatio\Bundle\CoreBundle\Lib\Locale::getDefault();
        return array("entities" => $entities);
    }

    /**
     * @Route("/new", name="EvocatioPostBundle_new")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->createEditForm(new Entity());

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new post entity.
     *
     * @Route("/new", name="EvocatioPostBundle_create")
     * @Method("POST")
     * @Template("EvocatioPostBundle:Default:new.html.twig")
     */
    public function createAction() {
        $edit_form = $this->createEditForm(new Entity());

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPostBundle_list'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        return array(
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPostBundle_edit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findOneEditables($id);

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
     * @Route("/{id}/edit", name="EvocatioPostBundle_update")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("EvocatioPostBundle:Default:edit.html.twig")
     */
    public function updateAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findOneEditables($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($entity);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPostBundle_list'));
        }
        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Set a post entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioPostBundle_toggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioPostBundle:Post', $id);
        if (!$entity) {
            throw new NotFoundHttpException("Post non trouvé");
        }
        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * Deletes a post entity.
     *
     * @Route("/{id}/delete", name="EvocatioPostBundle_delete")
     * @Method("POST")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $entity = $em->getRepository("EvocatioPostBundle:Post")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($entity);
        $em->flush();

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPostBundle_list'));
    }

    /**
     * @Route("/{slug}", name="EvocatioPostBundle_show_slug")
     * @Method("GET")
     * @Template("EvocatioPostBundle:Default:show.html.twig")
     */
    public function showFromSlugAction(EntityTranslation $entityTranslation) {
//        $delete_form = $this->createDeleteForm($id);
        $locale = $this->container->get("request")->get("_locale");
        if ($entityTranslation->getTransLang()->getSymbol() != $locale) {
            $slug = $entityTranslation->getParent()->getTranslationByLang($locale)->getSlug();
            return new RedirectResponse($this->container->get('router')->generate('EvocatioPostBundle_show_slug', array("slug" => $slug)));
        }
        $entity = $entityTranslation->getParent();

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($entity->getId());

        return array("entity" => $entity, 'delete_form' => $delete_form->createView()
        );
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param post $entity
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
