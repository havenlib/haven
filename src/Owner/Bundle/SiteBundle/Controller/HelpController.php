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

class HelpController extends ContainerAware {

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
//            $notifier->send();

            $this->container->get("session")->getFlashBag()->add("success", "message.sended");

//            return $this->redirectContactAction();
        }

        $this->container->get("session")->getFlashBag()->add("error", "form.error.message.not.sended");

        $template = str_replace(":performContact.html.twig", ":contact.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'edit_form' => $edit_form->createView()
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }

    protected function redirectContactAction() {
        return $this->redirectAction('owner_site_help_contact', array('contact'));
    }

    protected function redirectAction($route, $translate, $parameters = array()) {
        foreach ($translate as $word) {
            $parameters[$word] = $this->container->get('translator')->trans($word, array(), "routes");
        }

        return new RedirectResponse($this->container->get('router')->generate($route, $parameters));
    }

}

?>
