<?php

namespace Evocatio\Bundle\PosBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
//use Evocatio\Bundle\PosBundle\Form\ProductType as Form;
use Evocatio\Bundle\PosBundle\Entity\Product as Entity;
//Other includes
use Doctrine\Common\Annotations\AnnotationReader;
use \ReflectionClass;

class ProductController extends ContainerAware {

    /**
     * @Route("/", name="EvocatioPosBundle_ProductIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->findAll();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays a persona entity.
     *
     * @Route("/{id}/show", name="EvocatioPosBundle_ProductShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * Finds and displays all personas for admin.
     *
     * @Route("/list", name="EvocatioPosBundle_ProductList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->findAll();
//        echo "default : " .\Evocatio\Bundle\CoreBundle\Lib\Locale::getDefault();
        return array("entities" => $entities);
    }

    /**
     * @Route("/new/{discriminator}", name="EvocatioPosBundle_ProductNew")
     * @Method("GET")
     * @Template
     */
    public function newAction($discriminator) {

        $entity = $this->getEntity($discriminator);
        $edit_form = $this->createEditForm($entity);

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new persona entity.
     *
     * @Route("/new/{discriminator}", name="EvocatioPosBundle_ProductCreate")
     * @Method("POST")
     * @Template("EvocatioPosBundle:Default:new.html.twig")
     */
    public function createAction($discriminator) {
        $entity = $this->getEntity($discriminator);
        $edit_form = $this->createEditForm($entity);

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_ProductList'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        return array(
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_ProductEdit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }
        $edit_form = $this->createEditForm($entity);
        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/{id}/edit", name="EvocatioPosBundle_ProductUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("EvocatioPosBundle:Default:edit.html.twig")
     */
    public function updateAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($entity);
        $delete_form = $this->createDeleteForm($id);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_ProductList'));
        }
        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Set a persona entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioPosBundle_ProductToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioPosBundle:Product', $id);
        if (!$entity) {
            throw new NotFoundHttpException("Product non trouvé");
        }
        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * Deletes a persona entity.
     *
     * @Route("/{id}/delete", name="EvocatioPosBundle_ProductDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $entity = $em->getRepository("EvocatioPosBundle:Product")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($entity);
        $em->flush();

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_ProductList'));
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param persona $entity
     * @return Form or RedirectResponse   if validation error
     */
    protected function createEditForm($entity) {
//        the list of language here will decide what languages will appear in the form for new or edit.
        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(Array("status" => array(1, 2)));

        $entity->addTranslations($languages);

        $edit_form = $this->container->get('form.factory')->create($this->getForm($entity), $entity);
        return $edit_form;
    }

    /**
     *  Create the simple delete form
     * @param integer $id
     * @return form
     */
    protected function createDeleteForm($id) {
        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $edit_form
     * @return true or form
     */
    protected function processForm($edit_form) {
        if ($edit_form->isValid()) {
            $em = $this->container->get('Doctrine')->getEntityManager();
            $entity = $edit_form->getData();
            $em->persist($entity);
            $em->flush();

            return true;
        }

        return $edit_form;
    }

    protected function getEntity($discriminator = null) {
        $reader = new AnnotationReader();
        $class_annotations = $reader->getClassAnnotations(new ReflectionClass(new Entity()));
        $discriminator_map = current(array_filter($class_annotations, function ($object) {
                            return ($object instanceof \Doctrine\ORM\Mapping\DiscriminatorMap);
                        }));

        return (!empty($discriminator_map->value[$discriminator])) ? new $discriminator_map->value[$discriminator] : new Entity();
    }

    protected function getForm($entity, $form_class = null) {
        $form_class = (!empty($form_class))? $form_class : str_replace('\\Entity\\', '\\Form\\', get_class($entity)) . "Type";
        return new $form_class; 
    }

}
