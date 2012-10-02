<?php

namespace Evocatio\Bundle\CoreBundle\Controller;

#Symfony includes

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
#Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
#Evocatio includes
use Evocatio\Bundle\CoreBundle\Form\ChooseLanguageType;
use Evocatio\Bundle\CoreBundle\Lib\Locale;
use Evocatio\Bundle\CoreBundle\Entity\Language;

class DefaultController extends Controller {

    /**
     * @Route("/setup", name="setup_core")
     * @Template()
     */
    public function setupAction() {

        $em = $this->getDoctrine()->getEntityManager();
        $languages = $this->getDoctrine()->getRepository("EvocatioCoreBundle:Language")->findAll();

//        $this->getFileForLocale();
//        echo print_r(get_class_methods( $this->get('translator')));

        $languagesArray = $languages;
//        reduit languages en un array()
        array_walk($languagesArray, function (&$language) {
                    $language = $language->getSymbol();
                })

        ;
//        et le met dans un objet language pour peupler notre form
        $existingLanguages = new Language();
        $existingLanguages->setSymbol($languagesArray);
//        creer le form, et met l'info dedans
        $form = $this->createForm(new ChooseLanguageType());
//        $form->setData($existingLanguages);
//        assure que la language courante existe
        $this->checkDefaultLanguage();
        return array('form' => $form->createView(), 'languages' => $languages);
    }

    /**
     * @Route("/setup/culture", name="setup_culture_core")
     * @Template()
     */
    public function setupCultureAction() {
        $request = $this->getRequest();

        $form = $this->createForm(new ChooseLanguageType());
        $form->bindRequest($request);

        $locales = Locale::getSystemLocales();
        if ($form->isValid()) {
            $cultures = array();
            foreach ($form->get("symbol")->getData() as $symbol) {
                foreach ($locales as $locale) {
                    if ($symbol === Locale::getPrimaryLanguage($locale)) {
                        $cultures[$symbol][$locale] = Locale::getDisplayName($locale);
                    }
                }
            }

            return array('form' => null, 'cultures' => $cultures);
        }
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
     * @Route("/save", name="save_core")
     */
    public function saveSelectedLanguages() {
        $request = $this->getRequest();

        $form = $this->createForm(new ChooseLanguageType());
        $form->bindRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getEntityManager();
            $languages = $this->getDoctrine()->getRepository("EvocatioCoreBundle:Language")->findAll();
            $symboles = $form->get("symbol")->getData();

            /**
             * Get all languages for translation from form and enties.
             */
            foreach ($languages as $language) {
                if (!in_array($language->getSymbol(), $symboles)) {
                    $symboles[] = $language->getSymbol();
                }
            }
            
            foreach ($symboles as $symbol) {
                $language = current(array_filter($languages, function($language) use ($symbol) {
                                    return $language->getSymbol() == $symbol;
                                }));

                $language = (!$language) ? new Language() : $language;
                $language->setSymbol($symbol);
                $language->setStatus(true);
                $em->persist($language);


                foreach ($symboles as $translation_symbol) {
                    Locale::setDefault($translation_symbol);
                    $language_translation = $language->getTranslations()->filter(function ($translation) use ($symbol) {
                                        return $translation->getName() == Locale::getDisplayLanguage($symbol);
                                    })->current();

                    $language_translation = ($language_translation) ? $language_translation : new \Evocatio\Bundle\CoreBundle\Entity\LanguageTranslation();
                    $language_translation->setName(Locale::getDisplayLanguage($symbol));
                    $language_translation->setParent($language);
                    $em->persist($language_translation);
                }
            }
        }

        $em->flush();

        return $this->redirect($this->generateUrl("setup_core"));
//        $em = $this->getDoctrine()->getEntityManager();
////        assure que la language courante existe
//        $this->checkDefaultLanguage();
//        $post = $this->getRequest()->get("evocatio_bundle_corebundle_chooselanguagetype") ? $this->getRequest()->get("evocatio_bundle_corebundle_chooselanguagetype") : array('symbol' => array());
//        $languages = $this->getDoctrine()->getRepository("EvocatioCoreBundle:Language")->findAll();
//        if ($this->getRequest()->getMethod() == "POST" && !empty($post["symbol"])) {
////        create or update those that we want
//            foreach ($post["symbol"] as $symbol) {
//                if (!$current = current(array_filter($languages, function($language) use ($symbol) {
//                                    return $language->getSymbol() == $symbol;
//                                })
//                ))
//                    $current = new Language();
//                $current->setSymbol($symbol);
//                $current->setStatus(true);
//
//                $em->persist($current);
//            }
////        remove those we don't wanna keep
//            $toDelete = array_filter($languages, function($language) use ($post) {
//                        return (!in_array($language->getSymbol(), $post["symbol"]));
//                    })
//
//            ;
//            foreach ($toDelete as $efface) {
//                $em->remove($efface);
//            }
////        now commit
//            $em->flush();
//        } else {
//            if ($this->getRequest()->getMethod() == "POST")
//                $this->get('session')->setFlash('notice', 'minimum.1.language');
//        }
////         va chercher les languages existantes dans la db
//        $languages = $this->getDoctrine()->getRepository("EvocatioCoreBundle:Language")->findAll();
////        et pour chacune, met à jour les traductions
//        foreach ($languages as $language) {
////            ajoute toutes les traductions
//            $language->addTranslations($languages);
////            Pour chaques langues
//            foreach ($languages as $translation) {
////                Trouve tout les noms
//                $names = Locale::getAvailableDisplaySystemLocales($translation->getSymbol());
////                les assignent aux langues;
//                foreach ($language->getTranslations() as $languageTranslation) {
//                    if ($languageTranslation->getTransLang() == $translation)
//                        $languageTranslation->setName($names[$language->getSymbol()]);
//                }
//            }
//            $em->persist($language);
//        }
//        $em->flush();
//        return $this->redirect($this->generateUrl("setup_core"));
    }

    /**
     * @Route("/changeLanguage", name="change_language")
     */
    public function changeLanguageAction() {
        // if language exists and is status, set current language to it
        if ($this->getDoctrine()->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(array('status' => 1, 'symbol' => $this->getRequest()->get("lang")))) {
            $this->getRequest()->getSession()->set('_locale', $this->getRequest()->get("lang"));
        }

        return $this->redirect($this->getRequest()->server->get('HTTP_REFERER'));
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

}
