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
use Evocatio\Bundle\CoreBundle\Form\CultureType;

class CultureController extends ContainerAware {

    /**
     * @Route("/new/cultures/{display_language}", name="EvocatioCoreBundle_new_cultures")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $request = $this->container->get('Request');
        $doctrine = $this->container->get("Doctrine");
        $current_language = $doctrine->getRepository("EvocatioCoreBundle:Language")->findOneBy(array('symbol' => $request->get('display_language')));

        $existing_cultures = array();
        foreach ($current_language->getCultures() as $culture) {
            $existing_cultures[] = $culture->getSymbol();
        }

        $edit_form = $this->createEditForm($current_language, $existing_cultures);


        return array('edit_form' => $edit_form->createView(), 'language' => $current_language);
    }

    /**
     * @Route("/create/cultures", name="EvocatioFaqBundle_create_cultures")
     * @Method("POST")
     * @Template("EvocatioCoreBundle:Culture:new.html.twig")
     */
    public function createAction() {
        $request = $this->container->get('Request');
        $doctrine = $this->container->get("Doctrine");
        $current_language = $doctrine->getRepository("EvocatioCoreBundle:Language")->findOneBy(array('symbol' => $request->get('display_language')));

        $edit_form = $this->createEditForm($current_language);
        $edit_form->bindRequest($request);

        if ($this->processForm($edit_form, $current_language) == true) {
            return new RedirectResponse($this->container->get('router')->generate("EvocatioCoreBundle_new_cultures", array('display_language' => $current_language->getSymbol())));
        }

        return array('form' => $edit_form->createView());
    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $edit_form
     * @return true or form
     */
    public function processForm($edit_form, $language) {

        if ($edit_form->isValid()) {
            $em = $this->container->get("Doctrine")->getEntityManager();
            $languages = $em->getRepository("EvocatioCoreBundle:Language")->findAll();

            $cultures = $language->getCultures()->toArray();
            $selected_cultures = $edit_form->get("symboles")->getData();

            // Create new culture for current language if not exist and store them in the cultures array. 
            foreach ($selected_cultures as $key => $symbol) {
                $culture = current(array_filter($cultures, function($culture) use ($symbol) {
                                    return $culture->getSymbol() == $symbol;
                                }));

                if (!$culture) {
                    $culture_form = $this->container->get('form.factory')->create(new CultureType());
                    $culture_form->bind(array('symbol' => $symbol, 'status' => 1));
                    $culture = $culture_form->getData();
                    $culture->setLanguage($language);
                    $language->getCultures()->add($culture);
                }
            }

            //Translate each cultures to other languages, and persist.
            foreach ($language->getCultures() as $culture) {
                $culture->refreshTranslations($languages);
            }
            $em->persist($language);
            $this->removeCultures($selected_cultures, $language->getCultures(), $em);
            
            $em->flush();

            return true;
        }

        return $edit_form;
    }

    public function removeCultures($selected_cultures, $cultures, $em) {
        foreach ($cultures as $culture) {
            if (!in_array($culture->getSymbol(), $selected_cultures)) {
                $em->remove($culture);
            }
        }
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
