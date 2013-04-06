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
use Evocatio\Bundle\CoreBundle\Form\LanguageType;
use Evocatio\Bundle\CoreBundle\Lib\Locale;
use Evocatio\Bundle\CoreBundle\Entity\Language;

class LanguageController extends ContainerAware {

    /**
     * @Route("/language/new", name="EvocatioCoreBundle_new_languages")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        echo "<p>-->" . Locale::getDefault() . "</p>";
        echo "<p>session local-->" . $this->container->get("session")->get("_locale") . "</p>";

        $languages = $this->container->get("language.read_handler")->getAll();
        $edit_form = $this->container->get("language.form_handler")->createEditForm();
        return array('form' => $edit_form->createView(), 'languages' => $languages);
    }

    /**
     * @Route("/language/create", name="EvocatioCoreBundle_create_languages")
     * @Method("POST")
     * @Template("EvocatioCoreBundle:Core:new.html.twig")
     */
    public function createAction() {
        $request = $this->container->get('Request');

        $edit_form = $this->container->get("language.form_handler")->createEditForm();
        $edit_form->bindRequest($request);

        if ($edit_form->isValid()) {
            $this->container->get("language.persistence_handler")->save($edit_form->get("symboles")->getData());
            return new RedirectResponse($this->container->get('router')->generate("EvocatioCoreBundle_new_languages"));
        }

        return array('form' => $edit_form->createView());
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

//    public function processForm($edit_form) {
//        if ($edit_form->isValid()) {
//            $em = $this->container->get("Doctrine")->getEntityManager();
//            $language_repo = $em->getRepository("EvocatioCoreBundle:Language");
//
//            $languages = $language_repo->findAll();
//            $selected_languages = $edit_form->get("symboles")->getData();
//
//            // Create new language if not exist and store them in the languages array
//            foreach ($selected_languages as $key => $symbol) {
//                $language = current(array_filter($languages, function($language) use ($symbol) {
//                                    return $language->getSymbol() == $symbol;
//                                }));
//
//                if (!$language) {
//                    $language_form = $this->container->get('form.factory')->create(new LanguageType());
//                    $language_form->bind(array('symbol' => $symbol, "status" => 1));
//                    $language = $language_form->getData();
//                    $languages[] = $language;
//                }
//                $em->persist($language);
//            }
//
//            //Translate each language to other languages and persist.
//            foreach ($languages as $language) {
//                $language->refreshTranslations($languages);
//                $language->refreshMyCulturesTranslations($languages);
//            }
//            $this->removeLanguages($selected_languages, $languages, $em);
//            $em->flush();
//
//            return true;
//        }
//
//        return $edit_form;
//    }

//    public function removeLanguages($selected_languages, $languages, $em) {
//        foreach ($languages as $language) {
//            if (!in_array($language->getSymbol(), $selected_languages)) {
//                $em->remove($language);
//            }
//        }
//    }

}
