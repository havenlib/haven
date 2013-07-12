<?php

namespace Owner\Bundle\SiteBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Evocatio\Bundle\CmsBundle\Entity\PageTranslation as EntityTranslation;
use Evocatio\Bundle\CmsBundle\Controller\PageController as BasePageController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageController extends BasePageController {

    /**
     * Finds and displays a page entity.
     *
     * @Route("/page/{id}", requirements={"id" = "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function displayAction($id) {
        $entity = $this->container->get("page.read_handler")->get($id);
        $delete_form = $this->container->get("page.form_handler")->createDeleteForm($id);

        return array(
            'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * @Route("/page/{slug}", name="EvocatioWebBundle_PageDisplaySlug")
     * @Method("GET")
     * @Template
     */
    public function displayFromSlugAction($slug) {
//         @TODO remove the automatique finder, make a query with not just slug but slug and locale, so that a french and an english page can have the same slug
        $locale = $this->container->get("request")->get("_locale");
        
        $entity = $this->container->get("page.read_handler")->getBySlugForLanguage($slug, $locale);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->container->get("page.form_handler")->createDeleteForm($entity->getId());

        $template = str_replace(":displayFromSlug.html.twig", ":display.html.twig", $this->container->get("request")->get('_template'));

        $params = array(
            "entity" => $entity,
            'delete_form' => $delete_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    protected function redirectListAction() {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_page_list', array('list' => $this->container->get('translator')->trans("list", array(), "routes"))));
    }

    protected function redirectEditAction($id) {
        return new RedirectResponse($this->container->get('router')->generate('owner_site_page_edit', array(
                    'edit' => $this->container->get('translator')->trans("edit", array(), "routes")
                    , 'id' => $id)));
    }

}

?>
