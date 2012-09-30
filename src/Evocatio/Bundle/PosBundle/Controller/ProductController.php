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
use Evocatio\Bundle\PosBundle\Form\ProductType;
use Evocatio\Bundle\PosBundle\Entity\Product;
use Evocatio\Bundle\PosBundle\Entity\ProductTranslation;
use Evocatio\Bundle\CoreBundle\Lib\Locale;

class ProductController extends ContainerAware {

    /**
     * @Route("/", name="EvocatioPosBundle_ProductIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $product = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->findOnlines();

        return array("entities" => $product);
    }

    /**
     * Finds and displays all products for admin.
     *
     * @Route("/list", name="EvocatioPosBundle_ProductList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $products = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->findAll();

        return array("entities" => $products);
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}/show", name="EvocatioPosBundle_ProductShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        
        $product = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->findOneBy(array('id' => $id));

        if (!$product) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $product
        );
    }

    /**
     * @Route("/new", name="EvocatioPosBundle_ProductNew")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->createEditForm(new Product());

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="EvocatioPosBundle_ProductCreate")
     * @Method("POST")
     * @Template("EvocatioPosBundle:Product:new.html.twig")
     */
    public function createAction() {
        $edit_form = $this->createEditForm(new Product());

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
//        $this->container->get("session")->setFlash("notice", "we were in !");

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
        $product = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->findOneEditables($id);

        if (!$product) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createEditForm($product);
        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $product,
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
        $product = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Product")->findOneEditables($id);

        if (!$product) {
            throw new NotFoundHttpException('entity.not.found');
        }

//        update the update time
        $product->setUpdatedAt(new \DateTime());
        $edit_form = $this->createEditForm($product);
        $delete_form = $this->createDeleteForm($id);

        $edit_form->bindRequest($this->container->get('Request'));
        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_ProductShow', array('id' => $product->getId())));
        }
        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'product' => $product,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}/delete", name="EvocatioPosBundle_ProductDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {
        $delete_form = $this->createDeleteForm($id);
        $request = $this->container->get('Request');

        $delete_form->bindRequest($request);

        if ($delete_form->isValid()) {
            $em = $this->container->get('Doctrine')->getEntityManager();
            $product = $em->getRepository("EvocatioPosBundle:Product")->find($id);

            if (!$product) {
                throw new NotFoundHttpException('entity.not.found');
            }

            $em->remove($product);
            $em->flush();
        }

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_ProductList'));
    }

    /**
     * Set a product entity state to inactive.
     *
     * @Route("/{id}/state", name="EvocatioPosBundle_ProductToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $product = $em->find('EvocatioPosBundle:Product', $id);
        if (!$product) {
            throw new NotFoundHttpException("Product non trouvé");
        }
        $product->setStatus(!$product->getStatus());
        $em->persist($product);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * @Route("/{slug}", name="EvocatioPosBundle_ProductShowSlug")
     * @Method("GET")
     * @Template("EvocatioPosBundle:Default:show.html.twig")
     */
    public function showFromSlugAction(ProductTranslation $productTranslation) {
//        $delete_form = $this->createDeleteForm($id);
        if ($productTranslation->getTransLang()->getSymbol() != Locale::getPrimaryLanguage(Locale::getDefault())) {
            $slug = $productTranslation->getParent()->getTranslationByLang(Locale::getPrimaryLanguage(Locale::getDefault()))->getSlug();
            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_ProductShowSlug', array("slug" => $slug)));
        }
        $product = $productTranslation->getParent();

        if (!$product) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($product->getId());

        return array("entity" => $product, 'delete_form' => $delete_form->createView()
        );
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param product $product
     * @return Form or RedirectResponse   if validation error
     */
    private function createEditForm($product) {
//        the list of language here will decide what languages will appear in the form for new or edit.
        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(Array("status" => array(1, 2)));

        $product->addTranslations($languages);

        $edit_form = $this->container->get('form.factory')->create(new ProductType(), $product);
        return $edit_form;
    }

    /**
     *  Create the simple delete form
     * @param integer $id
     * @return form
     */
    private function createDeleteForm($id) {
        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
                ->add('id', 'hidden')
                ->getForm()
        ;
    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $form
     * @return true or form
     */
    private function processForm($edit_form) {
        if ($edit_form->isValid()) {
            $em = $this->container->get('Doctrine')->getEntityManager();
            $entity = $edit_form->getData();

            $uploader = $this->container->get("uploader");
            $uploader->uploadTranslatableEntityFile($entity, "actualite");
            
            $em->persist($entity);
            $em->flush();

            return true;
        }

        return $edit_form;
    }

}
