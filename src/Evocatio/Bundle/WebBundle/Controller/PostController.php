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
use Evocatio\Bundle\WebBundle\Entity\PostTranslation as EntityTranslation;

class PostController extends ContainerAware {

    protected $ROUTE_PREFIX = "evocatio_post";

    /**
     * @Route("/post")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("post.read_handler")->getAllPublished();
        return array("entities" => $entities);
    }

    /**
     * @Route("/admin/{show}/post/{id}", defaults={"show" = "afficher"})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("post.read_handler")->get($id);
        $delete_form = $this->container->get("post.form_handler")->createDeleteForm($id);

        return array(
            'entity' => $entity,
            "delete_form" => $delete_form->createView()
        );
    }

    /**
     * @Route("/admin/{list}/post")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("post.read_handler")->getAll();
        return array("entities" => $entities);
    }

    /**
     * @Route("/post/{slug}")
     * @Method("GET")
     * @Template()
     */
    public function displayAction(EntityTranslation $entityTranslation) {
        $locale = $this->container->get("request")->get("_locale");
        if ($entityTranslation->getTransLang()->getSymbol() != \Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale) && $entityTranslation->getParent()->getTranslationByLang(\Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale))) {
            $slug = $entityTranslation->getParent()->getTranslationByLang(\Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale))->getSlug();
            return new RedirectResponse($this->container->get('router')->generate($route = $this->ROUTE_PREFIX . '_post_display', array("slug" => $slug)));
        }
        $entity = $entityTranslation->getParent();

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->container->get("post.form_handler")->createDeleteForm($entity->getId());

        return array(
            "entity" => $entity,
            'delete_form' => $delete_form->createView()
        );
    }

    /**
     * @Route("/admin/{create}/post")
     * @Method("GET")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get("post.form_handler")->createNewForm();
        return array(
            'entity' => $edit_form->getData()
            , "edit_form" => $edit_form->createView()
        );
    }

    /**
     * Creates a new post entity.
     *
     * @Route("/admin/{create}/post")
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $edit_form = $this->container->get("post.form_handler")->createNewForm();

        $request = $this->container->get('request_modifier')->setRequest($this->container->get("Request"))
                ->slug(array("title"))
                ->getRequest();

        $edit_form->bind($request);

        if ($edit_form->get('save')->isClicked() && $edit_form->isValid()) {
            $this->container->get("post.persistence_handler")->save($edit_form->getData());

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_post_list', array(), array('list')));
        } else {
            if ($edit_form->get('template')->isClicked()) {
                $edit_form = $this->container->get("post.form_handler")->createNewForm($edit_form->getData());
            } else {
                $this->container->get("session")->getFlashBag()->add("error", "create.error");
            }
        }


        $template = str_replace(":add.html.twig", ":create.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'entity' => $edit_form->getData()
            , 'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/admin/{edit}/post/{id}")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get('post.read_handler')->get($id);
        $edit_form = $this->container->get("post.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("post.form_handler")->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/admin/{edit}/post/{id}")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $entity = $this->container->get('post.read_handler')->get($id);
        $edit_form = $this->container->get("post.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("post.form_handler")->createDeleteForm($entity->getId());

        $request = $this->container->get('request_modifier')->setRequest($this->container->get("request"))
                ->slug(array("title"))
                ->getRequest();

        $edit_form->bind($request);


        if ($edit_form->get('save')->isClicked() && $edit_form->isValid()) {
            $this->container->get("post.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->getFlashBag()->add("success", "update.success");

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_post_list', array(), array('list')));
        } else {
            if ($edit_form->get('template')->isClicked()) {
                $edit_form = $this->container->get("post.form_handler")->createNewForm($edit_form->getData());
            } else {
                $this->container->get("session")->getFlashBag()->add("error", "create.error");
            }
        }

        $template = str_replace(":update.html.twig", ":edit.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * Set a post entity state to inactive.
     *
     * @Route("/post/{id}/state", name="EvocatioWebBundle_PostToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioWebBundle:Post', $id);
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
     * @Route("/admin/post/{id}/delete", name="EvocatioWebBundle_PostDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $entity = $em->getRepository("EvocatioWebBundle:Post")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($entity);
        $em->flush();

        return new RedirectResponse($this->container->get('router')->generate('EvocatioWebBundle_PostList'));
    }

    /**
     * @Route("/post/{slug}")
     * @Method("GET")
     * @Template
     */
    public function showFromSlugAction(EntityTranslation $entityTranslation) {
        $locale = $this->container->get("request")->get("_locale");
        if ($entityTranslation->getTransLang()->getSymbol() != \Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale) && $entityTranslation->getParent()->getTranslationByLang(\Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale))) {
            $slug = $entityTranslation->getParent()->getTranslationByLang(\Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale))->getSlug();
            return new RedirectResponse($this->container->get('router')->generate($route = $this->ROUTE_PREFIX . '_post_showfromslug', array("slug" => $slug)));
        }
        $entity = $entityTranslation->getParent();

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->container->get("post.form_handler")->createDeleteForm($entity->getId());

        $template = str_replace(":showFromSlug.html.twig", ":show.html.twig", $this->container->get("request")->get('_template'));

        $params = array(
            "entity" => $entity,
            'delete_form' => $delete_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    public function listWidgetAction($template = null, $maximum = null) {
        $repo = $this->container->get('doctrine')->getRepository("EvocatioWebBundle:Post");
        $entities = $repo->findLastCreatedOnline($maximum);


        return new Response($this->container->get('templating')->render($template ? $template : 'EvocatioWebBundle:Post:list_widget.html.twig', array('entities' => $entities)));
    }

    /**
     *  /!\ Deprecated, devra être supprimer si plus utilisé.
     */
    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('evocatio_web_post_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

    protected function generateI18nRoute($route, $parameters = array(), $translate = array(), $lang = null, $absolute = false) {
        foreach ($translate as $word) {
            $parameters[$word] = $this->container->get('translator')->trans($word, array(), "routes", $lang);
        }
        return $this->container->get('router')->generate($route, $parameters, $absolute);
    }

}
