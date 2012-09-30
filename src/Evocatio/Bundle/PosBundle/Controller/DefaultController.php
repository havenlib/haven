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
use Evocatio\Bundle\PosBundle\Form\PostType;
use Evocatio\Bundle\PosBundle\Entity\Post;
use Evocatio\Bundle\PosBundle\Entity\PostTranslation;
use Evocatio\Bundle\CoreBundle\Lib\Locale;

class DefaultController extends ContainerAware {

    /**
     * @Route("/", name="EvocatioPosBundle_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $post = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Post")->findOnlines();

        return array("entities" => $post);
    }

    /**
     * Finds and displays all posts for admin.
     *
     * @Route("/list", name="EvocatioPosBundle_list")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $posts = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Post")->findAll();

        return array("entities" => $posts);
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/{id}/show", name="EvocatioPosBundle_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $post = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Post")->findOneBy(array('id' => $id));

        if (!$post) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $post
        );
    }

    /**
     * @Route("/new", name="EvocatioPosBundle_new")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->createEditForm(new Post());

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new post entity.
     *
     * @Route("/new", name="EvocatioPosBundle_create")
     * @Method("POST")
     * @Template("EvocatioPosBundle:Post:new.html.twig")
     */
    public function createAction() {
        $edit_form = $this->createEditForm(new Post());

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
        $this->container->get("session")->setFlash("notice", "we were in !");

            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_list'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        return array(
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_edit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $post = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Post")->findOneEditables($id);

        if (!$post) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($post);
        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $post,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_update")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("EvocatioPosBundle:Default:edit.html.twig")
     */
    public function updateAction($id) {
        $post = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Post")->findOneEditables($id);

        if (!$post) {
            throw new NotFoundHttpException('entity.not.found');
        }

//        update the update time
        $post->setUpdatedAt(new \DateTime());
        $edit_form = $this->createEditForm($post);
        $delete_form = $this->createDeleteForm($id);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_show', array('id' => $post->getId())));
        }
        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'post' => $post,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Deletes a post entity.
     *
     * @Route("/{id}/delete", name="EvocatioPosBundle_delete")
     * @Method("POST")
     */
    public function deleteAction($id) {
        $delete_form = $this->createDeleteForm($id);
        $request = $this->container->get('Request');

        $delete_form->bindRequest($request);

        if ($delete_form->isValid()) {
            $em = $this->container->get('Doctrine')->getEntityManager();
            $post = $em->getRepository("EvocatioPosBundle:Post")->find($id);

            if (!$post) {
                throw new NotFoundHttpException('entity.not.found');
            }

            $em->remove($post);
            $em->flush();
        }

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_list'));
    }

    /**
     * Set a post entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioPosBundle_toggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $post = $em->find('EvocatioPosBundle:Post', $id);
        if (!$post) {
            throw new NotFoundHttpException("Post non trouvé");
        }
        $post->setStatus(!$post->getStatus());
        $em->persist($post);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * @Route("/{slug}", name="EvocatioPosBundle_show_slug")
     * @Method("GET")
     * @Template("EvocatioPosBundle:Default:show.html.twig")
     */
    public function showFromSlugAction(PostTranslation $postTranslation) {
//        $delete_form = $this->createDeleteForm($id);
        if ($postTranslation->getTransLang()->getSymbol() != Locale::getPrimaryLanguage(Locale::getDefault())) {
            $slug = $postTranslation->getParent()->getTranslationByLang(Locale::getPrimaryLanguage(Locale::getDefault()))->getSlug();
            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_show_slug', array("slug" => $slug)));
        }
        $post = $postTranslation->getParent();

        if (!$post) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($post->getId());

        return array("entity" => $post, 'delete_form' => $delete_form->createView()
        );
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param post $post
     * @return Form or RedirectResponse   if validation error
     */
    private function createEditForm($post) {
//        the list of language here will decide what languages will appear in the form for new or edit.
        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(Array("status" => array(1, 2)));

        $post->addTranslations($languages);

        $edit_form = $this->container->get('form.factory')->create(new PostType(), $post);
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

            $uploader = $this->container->get("uploader");
            $uploader->uploadTranslatableEntityFile($entity, "actualite");
            
            $em->persist($entity);
            $em->flush();

            return true;
        }

        return $edit_form;
    }

}
