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
#Evocatio includes
use Evocatio\Bundle\CoreBundle\Lib\Locale;
use Evocatio\Bundle\CoreBundle\Entity\Language;
use \Evocatio\Bundle\CoreBundle\Form\ChooseCultureType;

class CultureController extends ContainerAware {

    /**
     * @Route("/new/cultures/{display_language}", name="choose_culture")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $request = $this->container->get('Request');
        $current_language = $this->container->get("Doctrine")->getRepository("EvocatioCoreBundle:Language")->findOneBy(array('symbol' => $request->get('display_language')));

        $existing_culture = array();
        foreach ($current_language->getCultures() as $culture) {
            $existing_culture[] = $culture->getSymbol();
        }

        $edit_form = $this->createEditForm($current_language, $existing_culture);


        return array('edit_form' => $edit_form->createView(), 'language' => $current_language);
    }

    /**
     * @Route("/create/cultures", name="save_culture_core")
     * @Method("POST")
     * @Template("EvocatioCoreBundle:Culture:new.html.twig")
     */
    public function createAction() {
        $request = $this->container->get('Request');
        $current_language = $this->container->get("Doctrine")->getRepository("EvocatioCoreBundle:Language")->findOneBy(array('symbol' => $request->get('display_language')));

        $edit_form = $this->createEditForm($current_language);
        $edit_form->bindRequest($request);

        if ($this->processForm($edit_form, $current_language) == true) {
            return new RedirectResponse($this->container->get('router')->generate("choose_culture", array('display_language' => $current_language->getSymbol())));
        }

        return array('form' => $form->createView());
    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $edit_form
     * @return true or form
     */
    public function processForm($edit_form, $language) {

        if ($edit_form->isValid()) {
            $em = $this->container->get("Doctrine")->getEntityManager();
            $languages = $this->container->get("Doctrine")->getRepository("EvocatioCoreBundle:Language")->findAll();

            $cultures = $language->getCultures()->toArray();

            // Instantiate all languages from form and entities. 
            foreach ($edit_form->get("symboles")->getData() as $key => $symbol) {
                $culture = current(array_filter($cultures, function($culture) use ($symbol) {
                                    return $culture->getSymbol() == $symbol;
                                }));
                if (!$culture) {
                    $culture = new \Evocatio\Bundle\CoreBundle\Entity\Culture();
                    $culture->setSymbol($symbol);
                    $culture->setStatus(true);
                    $culture->setLanguage($language);
                    $cultures[] = $culture;
                }

                $em->persist($culture);
            }

            //Translate current language to other languages
            foreach ($cultures as $culture) {
                $culture->addTranslations($languages);
                foreach ($culture->getTranslations() as $translation) {
                    Locale::setDefault($translation->getTransLang()->getSymbol());
                    $translation->setName(Locale::getDisplayRegion($culture->getSymbol()));
                }
            }

            $em->flush();
            return true;
        }

        return $edit_form;
    }

    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param faq $faq
     * @return Form or RedirectResponse   if validation error
     */
    protected function createEditForm($current_language, $existing_culture = array()) {
        $edit_form = $this->container->get('form.factory')->create(new ChooseCultureType(), array('symboles' => $existing_culture), array('display_language' => $current_language->getSymbol()));
        return $edit_form;
    }
    

}

?>
