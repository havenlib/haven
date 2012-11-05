<?php

namespace Evocatio\Bundle\PersonaBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
use Evocatio\Bundle\PersonaBundle\Entity\Persona as Entity;
use Evocatio\Bundle\PersonaBundle\Entity\PersonaTranslation as EntityTranslation;
use Evocatio\Bundle\CoreBundle\Controller\JoinedAdminController;

class PersonaAdminController extends JoinedAdminController {

    public $base_class = null;

    public function __construct() {
        $this->base_class = new Entity();
    }

    /**
     * Finds and displays all personas for admin.
     *
     * @Route("/list", name="EvocatioPersonaBundle_PersonaList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        return parent::listAction();
    }

    /**
     * @Route("/new/{discriminator}", name="EvocatioPersonaBundle_PersonaNew")
     * @Method("GET")
     * @Template
     */
    public function newAction($discriminator) {
        return parent::newAction($discriminator);
    }

    /**
     * Creates a new persona entity.
     *
     * @Route("/new/{discriminator}", name="EvocatioPersonaBundle_PersonaCreate")
     * @Method("POST")
     * @Template
     */
    public function createAction($discriminator) {
        return parent::createAction($discriminator);
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPersonaBundle_PersonaEdit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
//        ini_set('xdebug.max_nesting_level', 200);
        return parent::editAction($id);
    }
    
    /**
     * @Route("/{id}/edit", name="EvocatioPersonaBundle_PersonaUpdate")
     * @return RedirectResponse
     * @Method("POST")
     */
    public function updateAction($id) {
        return parent::updateAction($id);
    }
    /**
     * Set a persona entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioPersonaBundle_PersonaToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        return parent::toggleStateAction($id);
    }

    /**
     * Deletes a persona entity.
     *
     * @Route("/{id}/delete", name="EvocatioPersonaBundle_PersonaDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {
        return parent::deleteAction($id);
    }
    
    /**
     *
     * @Route("/choose-discriminator", name="EvocatioPersonaBundle_PersonaChooseDiscriminator")
     * @Method("GET")
     * @Template
     */
    public function chooseDiscriminatorAction() {
        return parent::chooseDiscriminatorAction();
    }
//
////  ------------- Privates -------------------------------------------
//    /**
//     * Creates an edit_form with all the translations objects added for status languages
//     * @param persona $entity
//     * @return Form or RedirectResponse   if validation error
//     */
//    protected function createEditForm($entity) {
////        the list of language here will decide what languages will appear in the form for new or edit.
//        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(Array("status" => array(1, 2)));
//
////        $entity->addTranslations($languages);
//
//        $edit_form = $this->container->get('form.factory')->create(new Form(), $entity);
//        return $edit_form;
//    }
//
//    /**
//     *  Create the simple delete form
//     * @param integer $id
//     * @return form
//     */
//    protected function createDeleteForm($id) {
//        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
//                        ->add('id', 'hidden')
//                        ->getForm()
//        ;
//    }
//
//    /**
//     * Validate and save form, if invalid returns form
//     * @param type $edit_form
//     * @return true or form
//     */
//    protected function processForm($edit_form) {
//        if ($edit_form->isValid()) {
//            $em = $this->container->get('Doctrine')->getEntityManager();
//            $entity = $edit_form->getData();
//            $em->persist($entity);
//            $em->flush();
//
//            return true;
//        }
//
//        return $edit_form;
//    }
}
