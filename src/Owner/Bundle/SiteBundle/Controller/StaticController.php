<?php

namespace Owner\Bundle\SiteBundle\Controller;

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
 *        "contact" = "contactez-nous|contact-us"
 *        , "historic" = "historique|historic"
 *        , "realisationprocess" = "realisation-process|processus-de-realisation"
 *        , "portfolio" = "portfolio|realisation"
 * })
 */
class StaticController extends ContainerAware {

    protected $ROUTE_PREFIX = "owner_site";

    /**
     * @Route("")
     * @Method("GET")
     * @Template
     */
    public function homeAction() {
        return array("entities" => "test");
    }

    /**
     * @Route("/{contact}")
     * @Method("GET")
     * @Template
     */
    public function contactAction() {
        $form = $this->container->get('form.factory')->create(new \Owner\Bundle\SiteBundle\Form\ContactType);
        return array('edit_form' => $form->createView());
    }

    /**
     * @Route("/{contact}")
     * @Method("POST")
     * @Template
     */
    public function performContactAction() {
        $edit_form = $this->container->get('form.factory')->create(new \Owner\Bundle\SiteBundle\Form\ContactType);
        $edit_form->bind($this->container->get('Request'));


        if ($edit_form->isValid()) {

            $notifier = $this->container->get('notifier');
            $notifier->createContactMail($edit_form->getData());
            $notifier->send();

            $this->container->get("session")->getFlashBag()->add("success", "message.sended");

            return new RedirectResponse($this->generateI18nRoute($route = $this->ROUTE_PREFIX . '_static_contact', array(), array('contact')));
        }

        $this->container->get("session")->getFlashBag()->add("error", "form.error.message.not.sended");

        $template = str_replace(":performContact.html.twig", ":contact.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    /**
     * @Route("/{historic}")
     * @Method("GET")
     * @Template
     */
    public function historicAction() {
        return array();
    }

    /**
     * @Route("/{realisationprocess}")
     * @Method("GET")
     * @Template
     */
    public function realisationAction() {
        return array();
    }

    /**
     * @Route("/{portfolio}")
     * @Method("GET")
     * @Template
     */
    public function portfolioAction() {
        return array();
    }

    protected function generateI18nRoute($route, $parameters = array(), $translate = array(), $lang = null, $absolute = false) {
        foreach ($translate as $word) {
            $parameters[$word] = $this->container->get('translator')->trans($word, array(), "routes", $lang);
        }
        return $this->container->get('router')->generate($route, $parameters, $absolute);
    }

}

?>
