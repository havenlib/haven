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
use Evocatio\Bundle\CoreBundle\Controller\JoinedViewController;

class PersonaViewController extends JoinedViewController {

    public $base_class = null;

    public function __construct() {
        $this->base_class = new Entity();
    }

    /**
     * @Route("/", name="EvocatioPersonaBundle_PersonaIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        return parent::indexAction();
    }

    /**
     * Finds and displays a persona entity.
     *
     * @Route("/{id}/show", name="EvocatioPersonaBundle_PersonaShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        parent::showAction($id);
    }

//    /**
//     * @Route("/{id}/edit", name="EvocatioPersonaBundle_update")
//     * @return RedirectResponse
//     * @Method("POST")
//     * @Template("EvocatioPersonaBundle:Default:edit.html.twig")
//     */
//    public function updateAction($id) {
//        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPersonaBundle:Persona")->findOneEditables($id);
//
//        if (!$entity) {
//            throw new NotFoundHttpException('entity.not.found');
//        }
//
//        $edit_form = $this->createEditForm($entity);
//        $delete_form = $this->createDeleteForm($id);
//
//        $edit_form->bindRequest($this->container->get('Request'));
//        if ($this->processForm($edit_form) === true) {
//            $this->container->get("session")->setFlash("success", "update.success");
//
//            return new RedirectResponse($this->container->get('router')->generate('EvocatioPersonaBundle_list'));
//        }
//        $this->container->get("session")->setFlash("error", "update.error");
//
//        return array(
//            'entity' => $entity,
//            'edit_form' => $edit_form->createView(),
//            'delete_form' => $delete_form->createView(),
//        );
//    }
//
//    /**
//     * Set a persona entity state to inactive.
//     *
//     * @Route("/{id}/state", name="EvocatioPersonaBundle_toggleState")
//     * @Method("GET")
//     */
//    public function toggleStateAction($id) {
//        $em = $this->container->get('doctrine')->getEntityManager();
//        $entity = $em->find('EvocatioPersonaBundle:Persona', $id);
//        if (!$entity) {
//            throw new NotFoundHttpException("Persona non trouvé");
//        }
//        $entity->setStatus(!$entity->getStatus());
//        $em->persist($entity);
//        $em->flush();
//
//        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
//    }
//
//    /**
//     * Deletes a persona entity.
//     *
//     * @Route("/{id}/delete", name="EvocatioPersonaBundle_delete")
//     * @Method("POST")
//     */
//    public function deleteAction($id) {
//
//        $em = $this->container->get('Doctrine')->getEntityManager();
//        $entity = $em->getRepository("EvocatioPersonaBundle:Persona")->find($id);
//
//        if (!$entity) {
//            throw new NotFoundHttpException('entity.not.found');
//        }
//
//        $em->remove($entity);
//        $em->flush();
//
//        return new RedirectResponse($this->container->get('router')->generate('EvocatioPersonaBundle_list'));
//    }
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
