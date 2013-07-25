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
// Evocatio includes
use Evocatio\Bundle\CmsBundle\Entity\Menu;

class MenuController extends ContainerAware {

    /**
     * Finds and all persona for admin.
     *
     * @Route("admin/{list}/menu")
     * @Method("GET")
     * @Template()
     * 
     * put an option here for the root node number, and make entities = child of node instead of all root menu, make all root menu if null
     */
    public function listAction() {
        $entities = $this->container->get("menu.read_handler")->getAllRootMenus();

        foreach ($entities as $entity) {
            $delete_forms[$entity->getId()] = $this->container->get("menu.form_handler")->createDeleteForm($entity->getId())->createView();
        }
//        echo "<pre>".print_r(get_class_methods(($entity)))."</pre>";

        return array(
            "entities" => $entities
            , 'delete_forms' => isset($delete_forms) && is_array($delete_forms) ? $delete_forms : array()
        );
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/admin/{show}/menu/{id}")
     * 
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("menu.read_handler")->get($id);
        $delete_form = $this->container->get("menu.form_handler")->createDeleteForm($id);

        return array(
            'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * @Route("/admin/{create}/menu/{parent}" ,defaults={"parent" = null})
     * @Method("GET")
     * @Template
     */
    public function createAction($parent) {

        if (is_null($parent)) {
            $edit_form = $this->container->get("menu.form_handler")->createNewForm();
        } else {
            $edit_form = $this->container->get("menu.form_handler")->createAddChildForm("\Evocatio\Bundle\CmsBundle\Form\MenuExternalLinkType");
        }

        return array("edit_form" => $edit_form->createView()
            , "parent" => $parent);
    }

    /**
     * @Route("/admin/{create}/menu/{parent}" ,defaults={"parent" = null})
     * @Method("POST")
     * @Template
     */
    public function addAction($parent) {
//        echo '<pre>';
//        print_r(get_class_methods($this->container->get("Request")));
//        echo '</pre>';
//        die();
        if (is_null($parent)) {
            $edit_form = $this->container->get("menu.form_handler")->createNewForm();
        } else {
            $edit_form = $this->container->get("menu.form_handler")->createAddChildForm("\Evocatio\Bundle\CmsBundle\Form\MenuExternalLinkType");
        }

        $edit_form->bind($this->container->get("request")->get("evocatio_bundle_cmsbundle_menutype"));


        if ($edit_form->isValid()) {
            if (is_null($parent)) {
                $this->container->get("menu.persistence_handler")->createRootMenu($edit_form->getData());
            } else {
                $this->container->get("menu.persistence_handler")->createChildMenu($edit_form->getData(), $parent);
            }
            $this->container->get("session")->getFlashBag()->add("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate(str_replace('add', "edit", $this->container->get("request")->get("_route")), array(
                        'edit' => $this->container->get('translator')->trans("edit", array(), "routes")
                        , 'id' => $edit_form->getData()->getId())));
        }

        $this->container->get("session")->getFlashBag()->add("error", "create.error");

        $template = str_replace(":add.html.twig", ":create.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
            , "parent" => $parent
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/admin/{edit}/menu/{id}")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get('menu.read_handler')->get($id);
        
        if (!$entity->hasParent()) {
            $edit_form = $this->container->get("menu.form_handler")->createEditForm($id);
        } else {
            $edit_form = $this->container->get("menu.form_handler")->createAddChildForm("\Evocatio\Bundle\CmsBundle\Form\MenuExternalLinkType", $id);
        }
//        $edit_form = $this->container->get("menu.form_handler")->createEditForm($id);
        return array(
            'entity' => $edit_form->getData(),
            'edit_form' => $edit_form->createView(),
        );
    }

    /**
     * @Route("/admin/{edit}/menu/{id}")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function updateAction($id) {
        $entity = $this->container->get('menu.read_handler')->get($id);
        
        if (!$entity->hasParent()) {
            $edit_form = $this->container->get("menu.form_handler")->createEditForm($id);
        } else {
            $edit_form = $this->container->get("menu.form_handler")->createAddChildForm("\Evocatio\Bundle\CmsBundle\Form\MenuExternalLinkType", $id);
        }
        
        $delete_form = $this->container->get("menu.form_handler")->createDeleteForm($entity->getId());

        $edit_form->bind($this->container->get("request")->get("evocatio_bundle_cmsbundle_menutype"));

        if ($edit_form->isValid()) {
            $this->container->get("menu.persistence_handler")->save($edit_form->getData());
            $this->container->get("session")->getFlashBag()->add("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate(str_replace('edit', "update", $this->container->get("request")->get("_route")), array(
                        'edit' => $this->container->get('translator')->trans("edit", array(), "routes")
                        , 'id' => $edit_form->getData()->getId())));
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
     * @Route("/admin/{delete}/menu")
     * @Method("POST")
     */
    public function deleteAction() {

        $form_data = $this->container->get("request")->get('form');
        $this->container->get("menu.persistence_handler")->delete($form_data['id']);

        return new RedirectResponse($this->container->get('router')->generate(str_replace('delete', "list", $this->container->get("request")->get("_route")), array(
                    'list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

}

?>
