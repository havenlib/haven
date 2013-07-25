<?php

namespace Evocatio\Bundle\PortfolioBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SheetController extends ContainerAware {

    protected $ROUTE_PREFIX = "evocatio_sheet";

    /**
     * @Route("/sheet")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("sheet.read_handler")->getAllPublished();
        return array("entities" => $entities);
    }

    /**
     * @Route("/admin/portfolio/{portfolio_id}/{list}/sheet")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $portfolio_id = $this->container->get('request')->get("portfolio_id");
        $entities = $this->container->get("sheet.read_handler")->getAll();
        return array("entities" => $entities, "portfolio_id" => $portfolio_id);
    }

    /**
     * @Route("/admin/portfolio/{portfolio_id}/{create}/sheet")
     * @Method("GET")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get("sheet.form_handler")->createNewForm();
        $portfolio_id = $this->container->get('request')->get("portfolio_id");

        return array("edit_form" => $edit_form->createView(), "portfolio_id" => $portfolio_id);
    }

    /**
     * Creates a new foglio entity.
     *
     * @Route("/admin/portfolio/{portfolio_id}/{create}/sheet")
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $portfolio_id = $this->container->get('request')->get("portfolio_id");
        $edit_form = $this->container->get("sheet.form_handler")->createNewForm();

        $request = $this->container->get('request_modifier')->setRequest($this->container->get("Request"))
                ->slug(array("name"))
                ->getRequest();

        $edit_form->bind($request);


        if ($edit_form->get('save')->isClicked() && $edit_form->isValid()) {
            $portfolio = $this->container->get("portfolio.read_handler")->get($portfolio_id);
            $edit_form->getData()->setPortfolio($portfolio);
            $this->container->get("sheet.persistence_handler")->save($edit_form->getData());

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_sheet_list', array(), array('list')));
        } else {
            $this->container->get("session")->getFlashBag()->add("error", "create.error");
        }


        $template = str_replace(":add.html.twig", ":create.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'entity' => $edit_form->getData()
            , 'edit_form' => $edit_form->createView()
            , "portfolio_id" => $portfolio_id
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/admin/portfolio/{portfolio_id}/{edit}/sheet/{id}")
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $portfolio_id = $this->container->get('request')->get("portfolio_id");
        $entity = $this->container->get('sheet.read_handler')->get($id);
        $edit_form = $this->container->get("sheet.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("sheet.form_handler")->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
            "portfolio_id" => $portfolio_id
        );
    }

    /**
     * @Route("/admin/portfolio/{portfolio_id}/{edit}/sheet/{id}")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $portfolio_id = $this->container->get('request')->get("portfolio_id");
        $entity = $this->container->get('sheet.read_handler')->get($id);
        $edit_form = $this->container->get("sheet.form_handler")->createEditForm($entity->getId());
        $delete_form = $this->container->get("sheet.form_handler")->createDeleteForm($entity->getId());

        $request = $this->container->get('request_modifier')->setRequest($this->container->get("request"))
                ->slug(array("name"))
                ->getRequest();

        $edit_form->bind($request);


        if ($edit_form->get('save')->isClicked() && $edit_form->isValid()) {
            $this->container->get("sheet.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->getFlashBag()->add("success", "update.success");

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_sheet_list', array("portfolio_id" => $portfolio_id), array('list')));
        } else {
            if ($edit_form->get('template')->isClicked()) {
                $edit_form = $this->container->get("sheet.form_handler")->createNewForm($edit_form->getData());
            } else {
                $this->container->get("session")->getFlashBag()->add("error", "create.error");
            }
        }

        $template = str_replace(":update.html.twig", ":edit.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
            "portfolio_id" => $portfolio_id
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    protected function generateI18nRoute($route, $parameters = array(), $translate = array(), $lang = null, $absolute = false) {
        foreach ($translate as $word) {
            $parameters[$word] = $this->container->get('translator')->trans($word, array(), "routes", $lang);
        }
        return $this->container->get('router')->generate($route, $parameters, $absolute);
    }

}
