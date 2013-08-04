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
     * @Route("/admin/{create}/menu/{parent}/{type}" ,defaults={"parent" = null, "type" = null})
     * @Method("GET")
     * @Template
     */
    public function createAction($parent, $type) {

        if (is_null($parent)) {
            $edit_form = $this->container->get("menu.form_handler")->createNewForm();
        } else if (!empty($type)) {
            $edit_form = $this->container->get("menu.form_handler")->createAddChildForm($type);
        } else {
            throw new \Exception("can't execute add child with no type");
        }

        $pages = $this->container->get('page.read_handler')->getList();
        foreach ($pages as $page) {
            echo "<p>" . $page->getTitle() . " " . $page->getId() . "</p>";
        }

        return array("edit_form" => $edit_form->createView()
            , "parent" => $parent);
    }

    /**
     * @Route("/admin/{create}/menu/{parent}/{type}" ,defaults={"parent" = null, "type" = null})
     * @Method("POST")
     * @Template
     */
    public function addAction($parent, $type) {
//        echo '<pre>';
//        print_r(get_class_methods($this->container->get("Request")));
//        echo '</pre>';
//        die();
        if (is_null($parent)) {
            $edit_form = $this->container->get("menu.form_handler")->createNewForm();
        } else if (!empty($type)) {
            $edit_form = $this->container->get("menu.form_handler")->createAddChildForm($type);
        } else {
            throw new \Exception("can't execute add child with no type");
        }

        $edit_form->bind($this->container->get("request")->get("evocatio_bundle_cmsbundle_menutype"));


        if ($edit_form->isValid()) {
            if (is_null($parent)) {
                $this->container->get("menu.persistence_handler")->createRootMenu($edit_form->getData());
            } else if (!empty($type)) {
                switch ($type) {
                    case "external" :
                        $edit_form->getData()->setType('external');
                        $this->container->get("menu.persistence_handler")->createChildMenu($edit_form->getData(), $parent);
                        break;
                    case "internal" :
                        $edit_form->getData()->setType('internal');
                        $page = $this->container->get("page.read_handler")->get($edit_form->get("page")->getData()->getId());
                        $this->container->get("menu.persistence_handler")->createChildMenu($edit_form->getData(), $parent, $page);
                        break;
                    default :
                        $edit_form = $this->container->get("menu.form_handler")->createNewForm();
                        break;
                }
            } else {
                throw new \Exception("can't execute add child with no type");
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

//        echo $entity->getNode()->getType();
//        die();
        if (!$entity->hasParent()) {
            $edit_form = $this->container->get("menu.form_handler")->createEditForm($id);
        } else {
            $edit_form = $this->container->get("menu.form_handler")->createAddChildForm($entity->getNode()->getType(), $id);
        }
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
            $edit_form = $this->container->get("menu.form_handler")->createAddChildForm($entity->getNode()->getType(), $id);
        }

        $delete_form = $this->container->get("menu.form_handler")->createDeleteForm($entity->getId());

        $edit_form->bind($this->container->get("request")->get("evocatio_bundle_cmsbundle_menutype"));

        if ($edit_form->isValid()) {
            $type = $entity->getNode()->getType();
            if (!$entity->hasParent()) {
                $this->container->get("menu.persistence_handler")->createRootMenu($edit_form->getData());
            } else if (!empty($type)) {
                $parent = $entity->getParent();
                echo 'parent id ->'.$parent->getId().'<-id';
                switch ($type) {
                    case "external" :
//                        $edit_form->getData()->setType('external');
                        $this->container->get("menu.persistence_handler")->createChildMenu($edit_form->getData(), $parent);
                        break;
                    case "internal" :
//                        $edit_form->getData()->setType('internal');
//                        echo 'page: ' . get_class($edit_form);
//                        die('laksdjf');
                        $page = $this->container->get("page.read_handler")->get($edit_form->get("page")->getData()->getId());
                        $this->container->get("menu.persistence_handler")->save($edit_form->getData(), $page);
                        break;
                    default :
                        $edit_form = $this->container->get("menu.form_handler")->createNewForm();
                        break;
                }
            } else {
                throw new \Exception("can't execute add child with no type");
            }

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
