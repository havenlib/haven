<?php

namespace Evocatio\Bundle\CmsBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Request;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class PageController extends ContainerAware {

    /**
     * @Route("/admin/{new}/page")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->container->get("page.form_handler")->createNewForm();
        return array("edit_form" => $edit_form->createView());
    }

    public function editAccueilAction() {

//        $em = $this->getDoctrine()->getEntityManager();
//        $page = $this->container->get("cmspage.read_handler")->get($id);
//        current($em->getRepository('tahuaSiteBundle:CmsPageAccueil')->findAll());

        if (is_null($page))
            $page = new \tahua\SiteBundle\Entity\CmsPageAccueil();

        $page->createMissingAndIndexContents();
        $form = $this->createForm(new CmsPageType(), $page);

        return $this->render("tahuaSiteBundle:Page:new.html.twig", array("form" => $form->createView()));
    }

    public function updateAccueilAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $page = current($em->getRepository('tahuaSiteBundle:CmsPageAccueil')->findAll());

        if (is_null($page))
            $page = new \tahua\SiteBundle\Entity\CmsPageAccueil();

        $page->createMissingAndIndexContents();

        $form = $this->createForm(new CmsPageType(), $page);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($page);
            $em->flush();
        }

        return $this->render("tahuaSiteBundle:Page:new.html.twig", array("form" => $form->createView()));
    }

    public function editTherapeutesAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $page = current($em->getRepository('tahuaSiteBundle:CmsPageAccueil')->findAll());

        if (is_null($page)) {
            $page = new \tahua\SiteBundle\Entity\CmsPageAccueil();
        }
        $page->createMissingAndIndexContents();
        $form = $this->createForm(new CmsPageType(), $page);

        return $this->render("tahuaSiteBundle:Page:new.html.twig", array("form" => $form->createView()));
    }

}

?>
