<?php

namespace Evocatio\Bundle\CmsBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageController extends ContainerAware {

    /**
     * Finds and all persona for admin.
     *
     * @Route("admin/{list}/page")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("page.read_handler")->getAll();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/admin/{show}/page/{id}")
     * 
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("page.read_handler")->get($id);
        $delete_form = $this->container->get("page.form_handler")->createDeleteForm($id);

        return array(
            'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * @Route("/admin/{create}/page")
     * @Method("GET")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get("page.form_handler")->createNewForm();
        return array("edit_form" => $edit_form->createView());
    }

    /**
     * @Route("/admin/{create}/page")
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $edit_form = $this->container->get("page.form_handler")->createNewForm();
        $edit_form->bindRequest($this->container->get('Request'));


        if ($edit_form->isValid()) {
            $this->container->get("page.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('evocatio_cms_page_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
        }

        $this->container->get("session")->setFlash("error", "create.error");

        $template = str_replace(":create.html.twig", ":new.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/admin/{edit}/page/{id}")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get('page.read_handler')->get($id);
        $edit_form = $this->container->get("page.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("page.form_handler")->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/admin/{edit}/page/{id}")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $entity = $this->container->get('page.read_handler')->get($id);
        $edit_form = $this->container->get("page.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("page.form_handler")->createDeleteForm($entity->getId());


        $edit_form->bindRequest($this->container->get('Request'));
        if ($edit_form->isValid()) {
            $this->container->get("page.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('evocatio_cms_page_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
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

//    public function editAccueilAction() {
//
////        $em = $this->getDoctrine()->getEntityManager();
////        $page = $this->container->get("cmspage.read_handler")->get($id);
////        current($em->getRepository('tahuaSiteBundle:CmsPageAccueil')->findAll());
//
//        if (is_null($page))
//            $page = new \tahua\SiteBundle\Entity\CmsPageAccueil();
//
//        $page->createMissingAndIndexContents();
//        $form = $this->createForm(new CmsPageType(), $page);
//
//        return $this->render("tahuaSiteBundle:Page:new.html.twig", array("form" => $form->createView()));
//    }
//
//    public function updateAccueilAction(Request $request) {
//        $em = $this->getDoctrine()->getEntityManager();
//        $page = current($em->getRepository('tahuaSiteBundle:CmsPageAccueil')->findAll());
//
//        if (is_null($page))
//            $page = new \tahua\SiteBundle\Entity\CmsPageAccueil();
//
//        $page->createMissingAndIndexContents();
//
//        $form = $this->createForm(new CmsPageType(), $page);
//        $form->bindRequest($request);
//
//        if ($form->isValid()) {
//            $em = $this->getDoctrine()->getEntityManager();
//            $em->persist($page);
//            $em->flush();
//        }
//
//        return $this->render("tahuaSiteBundle:Page:new.html.twig", array("form" => $form->createView()));
//    }
//
//    public function editTherapeutesAction() {
//
//        $em = $this->getDoctrine()->getEntityManager();
//        $page = current($em->getRepository('tahuaSiteBundle:CmsPageAccueil')->findAll());
//
//        if (is_null($page)) {
//            $page = new \tahua\SiteBundle\Entity\CmsPageAccueil();
//        }
//        $page->createMissingAndIndexContents();
//        $form = $this->createForm(new CmsPageType(), $page);
//
//        return $this->render("tahuaSiteBundle:Page:new.html.twig", array("form" => $form->createView()));
//    }
}

?>
