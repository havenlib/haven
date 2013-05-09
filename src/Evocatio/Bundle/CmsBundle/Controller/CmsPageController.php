<?php

namespace Evocatio\Bundle\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use tahua\SiteBundle\Form\CmsPageType;
use tahua\SiteBundle\Entity\CmsPage;
use Symfony\Component\HttpFoundation\Request;
/**
 * Entities
 */
use tahua\SiteBundle\Entity\CmsContent;
use tahua\SiteBundle\Entity\CmsContentTranslation;

class CmsPageController extends Controller {

    public function editAccueilAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $page = current($em->getRepository('tahuaSiteBundle:CmsPageAccueil')->findAll());

        if (is_null($page))
            $page = new \tahua\SiteBundle\Entity\CmsPageAccueil();

        $page->createMissingAndIndexContents();
        $form = $this->createForm(new CmsPageType(), $page);

        return $this->render("tahuaSiteBundle:CmsPage:new.html.twig", array("form" => $form->createView()));
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

        return $this->render("tahuaSiteBundle:CmsPage:new.html.twig", array("form" => $form->createView()));
    }

    public function editTherapeutesAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $page = current($em->getRepository('tahuaSiteBundle:CmsPageAccueil')->findAll());

        if (is_null($page)) {
            $page = new \tahua\SiteBundle\Entity\CmsPageAccueil();
        }
        $page->createMissingAndIndexContents();
        $form = $this->createForm(new CmsPageType(), $page);

        return $this->render("tahuaSiteBundle:CmsPage:new.html.twig", array("form" => $form->createView()));
    }

}

?>
