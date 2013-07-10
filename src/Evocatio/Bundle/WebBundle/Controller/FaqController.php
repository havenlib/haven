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

/**
 * @Route("", requirements={
 *      "rank" = "rank"
 * })
 */
class FaqController extends ContainerAware {

    protected $ROUTE_PREFIX = "evocatio_faq";

    /**
     * @Route("/faq")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("faq.read_handler")->getAllPublished();
        return array("entities" => $entities);
    }

    /**
     * @Route("/admin/{rank}/faq")
     * @Method("GET")
     * @Template
     */
    public function rankAction() {
        $form = $this->container->get("faq.form_handler")->createRankForm();
        return array("edit_form" => $form->createView());
    }

    /**
     * @Route("/admin/{rank}/faq")
     * @Method("POST")
     * @Template
     */
    public function performRankingAction() {
        $form = $this->container->get("faq.form_handler")->createRankForm();
        $form->bind($this->container->get('Request'));


        if ($form->isValid()) {
            $this->container->get("faq.persistence_handler")->batchSave($form->get("faqs")->getData());
            $this->container->get("session")->getFlashBag()->add("success", "ranking.success");

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_faq_list', array(), array('list')));
        }
        die("ranking error");

        $this->container->get("session")->getFlashBag()->add("error", "create.error");

        $template = str_replace(":add.html.twig", ":create.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * Finds and displays all faqs for admin.
     *
     * @Route("/admin/{list}/faq")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
//        $entities = $this->container->get("faq.read_handler")->getAll();
//        return array();
        $form = $this->container->get("faq.form_handler")->createRankForm();
        $entities = $form->get("faqs")->getData();
        return array("edit_form" => $form->createView(), "entities" => $entities);
    }

    /**
     * @Route("/admin/{create}/faq")
     * @Method("GET")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get("faq.form_handler")->createNewForm();
        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new faq entity.
     *
     * @Route("/admin/{create}/faq")
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $edit_form = $this->container->get("faq.form_handler")->createNewForm();
        $edit_form->bind($this->container->get('Request'));


        if ($edit_form->isValid()) {
            $this->container->get("faq.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->getFlashBag()->add("success", "create.success");

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_faq_list', array(), array('list')));
        }

        $this->container->get("session")->getFlashBag()->add("error", "create.error");

        $template = str_replace(":add.html.twig", ":create.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/admin/{edit}/faq/{id}")
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
     * @Route("/admin/{edit}/faq/{id}")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $entity = $this->container->get('faq.read_handler')->get($id);
        $edit_form = $this->container->get("faq.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("faq.form_handler")->createDeleteForm($entity->getId());


        $edit_form->bind($this->container->get('Request'));
        if ($edit_form->isValid()) {
            $this->container->get("faq.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->getFlashBag()->add("success", "create.success");

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_faq_list', array(), array('list')));
        }
        $this->container->get("session")->getFlashBag()->add("error", "update.error");

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

    protected function generateI18nRoute($route, $parameters = array(), $translate = array(), $lang = null, $absolute = false) {
        foreach ($translate as $word) {
            $parameters[$word] = $this->container->get('translator')->trans($word, array(), "routes", $lang);
        }
        return $this->container->get('router')->generate($route, $parameters, $absolute);
    }

}
