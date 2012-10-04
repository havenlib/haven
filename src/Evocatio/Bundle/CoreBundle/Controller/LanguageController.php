<?php

namespace Evocatio\Bundle\CoreBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//Evocatio includes
use Evocatio\Bundle\CoreBundle\Form\ChooseLanguageType;
use Evocatio\Bundle\CoreBundle\Lib\Locale;
use Evocatio\Bundle\CoreBundle\Entity\Language;

class LanguageController extends ContainerAware {

    /**
     *  @Route("test")
     *  
     */
    public function testAction() {
        echo "<p>-->" . \Evocatio\Bundle\CoreBundle\Lib\Locale::getDefault() . "</p>";
        echo "<p>session local-->" . $this->container->get("session")->get("_locale") . "</p>";
        echo "<p>request local-->" . $this->container->get("request")->get("_locale") . "</p>";
        die();
    }

    /**
     * @Route("/new/languages", name="EvocatioCoreBundle_new_languages")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        echo "<p>-->" . Locale::getDefault() . "</p>";
        echo "<p>session local-->" . $this->container->get("session")->get("_locale") . "</p>";
        $request = $this->container->get('Request');
        $languages = $this->container->get("Doctrine")->getRepository("EvocatioCoreBundle:Language")->findAll();


        //reduit languages en un array()
        $existing_languages = $languages;
        array_walk($existing_languages, function (&$language) {
                    $language = $language->getSymbol();
                });

        $edit_form = $this->createEditForm($existing_languages);

        //assure que la language courante existe
//        $this->checkDefaultLanguage();
        return array('form' => $edit_form->createView(), 'languages' => $languages);
    }

    /**
     * @Route("/create/languages", name="EvocatioCoreBundle_create_languages")
     * @Method("POST")
     * @Template("EvocatioCoreBundle:Default:new.html.twig")
     */
    public function saveSelectedLanguages() {
        $request = $this->container->get('Request');

        $edit_form = $this->createEditForm();
        $edit_form->bindRequest($request);

        if ($this->processForm($edit_form) == true) {
            return new RedirectResponse($this->container->get('router')->generate("EvocatioCoreBundle_new_languages"));
        }

        return array('form' => $form->createView());
    }

    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param faq $faq
     * @return Form or RedirectResponse   if validation error
     */
    protected function createEditForm($existing_languages = array()) {
        $edit_form = $this->container->get('form.factory')->create(new ChooseLanguageType(), array('symboles' => $existing_languages));
        return $edit_form;
    }

    private function getFileForLocale() {
//        devrait aller chercher tout les informations de traduction pour chaque language, pour chaque bundle
        echo "<pre>";
        if (file_exists('../src/Evocatio/Bundle/CoreBundle/Resources/translations/messages.fr.xliff')) {
            $xml = simplexml_load_file('../src/Evocatio/Bundle/CoreBundle/Resources/translations/messages.fr.xliff');

            print_r($xml);
            echo "</pre>";
            $test = $xml;
            while ($test->getName() != 'body') {
                echo $test->getName();
                $test = $test->Children();
            }
            $new = $test->addChild("trans-unit");
            $new->addAttribute("id", 3);
            $renew = $new->addChild('source', "succes");
            $renew = $new->addChild('target', 'bilbo');
            echo "<pre>-->";
            echo $xml->asXML("../src/Evocatio/Bundle/CoreBundle/Resources/translations/messages.fr.xliff");
            echo "<--</pre>";
            foreach ($test->Children() as $node) {
                echo $node->Attributes();
                print_r($node->Attributes());
            }
        } else {
            exit('Failed to open test.xml.');
        }
    }

    /**
     * @Route("/changeLanguage", name="change_language")
     */
    public function changeLanguageAction() {
        $router = $this->container->get("router");
        $doctrine = $this->container->get("Doctrine");
        $request = $this->container->get("Request");

        // if language exists and is status, set current language to it
        if ($doctrine->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(array('status' => 1, 'symbol' => $request->get("lang")))) {
//        get the base URL to remove form http_referer to get URI
            $urlBaseReferer = $router->getContext()->getScheme() . "://" . $router->getContext()->getHost() . $router->getContext()->getBaseUrl();
//        figuring out the referers route information 
            $uri = str_replace($urlBaseReferer, "", $request->server->get('HTTP_REFERER'));
            $routeArray = $router->match($uri);
//        changing the locale to the current one while probably have to manage sluggable around here
            $routeArray["_locale"] = $request->get("lang");

            $route = $routeArray["_route"];
            unset($routeArray["_route"]);
//        $this->container->get("session")->setFlash("error", "lang is : " . print_r($routeArray,true) );  //   $router->match($this->getRequest()->server->get('HTTP_REFERER')));

            return new RedirectResponse($this->container->get('router')->generate($route, $routeArray));
        }
        return new RedirectResponse($this->getRequest()->server->get('HTTP_REFERER'));
    }

    /**
     *  Vérifie si la language courante existe et est status sinon defaults to 'symfony fallback'
     */
    private function checkDefaultLanguage() {
        if (!$this->getDoctrine()->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(array('status' => 1, 'symbol' => Locale::getDefault()))) {
            if ($default = $this->getDoctrine()->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findOneBy(array('status' => true)))
                $this->getRequest()->getSession()->set('_locale', $default->getSymbol());
            else
                $this->getRequest()->getSession()->set('_locale', "fr");
        }
    }

    /**
     * Cette action sert à render un widget de selection de la language
     * @Route("/switcher", name="core_switcher_widget")
     * @param <string> $template        Le template à utiliser pour lister les languages
     * @param <boolean> $status         Si l'on doit retourner seulement les languages statuss
     */
    public function i18nSwitcherAction($template = null, $status = true) {
        $rep = $this->container->get("Doctrine")->getRepository("EvocatioCoreBundle:Language");
        $languages = $status ? $rep->findByStatus(true) : $rep->findAll();
        return new Response(
                        $this->container->get('templating')->render(
                                $template ? $template : 'EvocatioCoreBundle:Default:i18nSwitcher.html.twig'
                                , array('languages' => $languages)
                ));
    }

    public function processForm($edit_form) {
        if ($edit_form->isValid()) {
            $em = $this->container->get("Doctrine")->getEntityManager();
            $languages = $this->container->get("Doctrine")->getRepository("EvocatioCoreBundle:Language")->findAll();


            // Instantiate all languages from form and entities. 
            foreach ($edit_form->get("symboles")->getData() as $key => $symbol) {
                $language = current(array_filter($languages, function($language) use ($symbol) {
                                    return $language->getSymbol() == $symbol;
                                }));
                if (!$language) {
                    $language = new Language();
                    $language->setSymbol($symbol);
                    $language->setStatus(true);
                    $languages[] = $language;
                }

                $em->persist($language);
            }

            //Translate current language to other languages
            foreach ($languages as $language) {
                $language->addTranslations($languages);
                foreach ($language->getTranslations() as $translation) {
                    Locale::setDefault($translation->getTransLang()->getSymbol());
                    $translation->setName(Locale::getDisplayLanguage($language->getSymbol()));
                }
            }

            $em->flush();
            return true;
        }

        return $edit_form;
    }

}
