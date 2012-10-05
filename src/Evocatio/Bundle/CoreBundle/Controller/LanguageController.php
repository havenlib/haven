<?php

namespace Evocatio\Bundle\CoreBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
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

        return array('form' => $edit_form->createView());
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

    public function processForm($edit_form) {
        if ($edit_form->isValid()) {
            $em = $this->container->get("Doctrine")->getEntityManager();
            $language_repo = $em->getRepository("EvocatioCoreBundle:Language");

            $languages = $language_repo->findAll();
            
            // Create new language if not exist and store them in the languages array
            foreach ($edit_form->get("symboles")->getData() as $key => $symbol) {
                $language = current(array_filter($languages, function($language) use ($symbol) {
                                    return $language->getSymbol() == $symbol;
                                }));

                if (!$language) {
                    $language_form = $this->container->get('form.factory')->create(new LanguageType());
                    $language_form->bind( array('symbol' => $symbol, "status" => 1 ));
                    $languages[] = $language_form->getData();
                }
            }

            //Translate each language to other languages and persist.
            foreach ($languages as $language) {
                $language->refreshTranslations($languages);
                $em->persist($language);
            }
            $em->flush();

            return true;
        }

        return $edit_form;
    }

}
