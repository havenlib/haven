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
     */
    public function listAction() {
        $entities = $this->container->get("menu.read_handler")->getAllRootMenus();
//        foreach ($entities as $entity){
//            echo $entity->getId()."<br />";
//        }
//
////        echo '<pre>';
//
//        $em = $this->container->get("doctrine")->getEntityManager();
//        $config = new \Evocatio\Bundle\CoreBundle\Lib\NestedSet\Config($em, 'Evocatio\Bundle\CmsBundle\Entity\Menu');
//        $nsm = new \Evocatio\Bundle\CoreBundle\Lib\NestedSet\Manager($config);
//
////        $menu = $this->container->getRepository("Evocatio\Bundle\CmsBundle\Entity\Menu")->find();
//        
////        print_r (($this->container->get("router")->getRouteCollection()->all()));
//        
////        $menu = new Menu();
////        $menu->setType('Root Menu 2');
//
////        $rootNode = $nsm->createRoot($menu);
//        $rootNode = $nsm->fetchTree(3);
//////
////        $child1 = new Menu();
////        $child1->setType('Child Menu 3');
////
////        $child2 = new Menu();
////        $child2->setType('Child Menu 4');
//////
////        $rootNode->addChild($child1);
////        $rootNode->addChild($child2);
////        
//        foreach($rootNode->getDescendants() as $childs){
//            
////            echo 'done-> '.print_r(get_class_methods($childs),1);
////            echo 'done-> '.$childs;
//        }
////
////        $collection = $this->container->get("router")->getRouteCollection();
////        foreach ($collection as $name => $route)
////            echo "<br />" . print_r($name, 1) . "<br />";
////        echo "<br />" . print_r(get_class_methods($this->container->get("router")), 1) . "<br />";
//        echo "<div style=' width: 45%; display:inline-block'><pre>" . print_r($this->container->get("request")->get("_route"), 1) . "</pre></div>";
//        echo "<div style=' width: 45%;display:inline-block '><pre>" .print_r ($this->container->get("request")->get("_route_params"), 1) . "</pre></div>";
//        $route = new \Evocatio\Bundle\CmsBundle\Lib\MenuRoute($this->container->get("request")->get("_route"), $this->container->get("request")->get("_route_params"));
//        echo '<br />';
//        print_r($route);
//        echo '<br />';
//        echo $this->container->get('router')->generate($route->getRoute(), $route->getParameters());
//        echo '<br />';
//        $serializeRoute =  serialize($route);
//        echo $serializeRoute;
//        echo '<br />';
//        print_r(unserialize($serializeRoute));
////        echo '</pre>';
////        die();

        foreach ($entities as $entity) {
            $delete_forms[$entity->getId()] = $this->container->get("menu.form_handler")->createDeleteForm($entity->getId())->createView();
        }
        return array("entities" => $entities
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
     * @Route("/admin/{create}/menu")
     * @Method("GET")
     * @Template
     */
    public function createAction() {
        $edit_form = $this->container->get("menu.form_handler")->createNewForm();

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * @Route("/admin/{create}/menu")
     * @Method("POST")
     * @Template
     */
    public function addAction() {
        $edit_form = $this->container->get("menu.form_handler")->createNewForm();

        $edit_form->bind($this->container->get("request")->get("evocatio_bundle_cmsbundle_menutype"));


        if ($edit_form->isValid()) {
            $this->container->get("menu.persistence_handler")->createRootMenu($edit_form->getData());
            $this->container->get("session")->getFlashBag()->add("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate(str_replace('add', "edit", $this->container->get("request")->get("_route")), array(
                        'edit' => $this->container->get('translator')->trans("edit", array(), "routes")
                        , 'id' => $edit_form->getData()->getId())));
        }

        $this->container->get("session")->getFlashBag()->add("error", "create.error");

        $template = str_replace(":add.html.twig", ":create.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
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
        $edit_form = $this->container->get("menu.form_handler")->createEditForm($id);
        return array(
            'entity' => $entity,
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
        $edit_form = $this->container->get("menu.form_handler")->createEditForm($entity->getId());
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
