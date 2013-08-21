<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Stéphan Champagne <sc@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
use Evocatio\Bundle\PosBundle\Form\BasketType as Form;
use Evocatio\Bundle\PosBundle\Entity\Purchase as Entity;

class BasketController extends ContainerAware {

    /**
     * @Route("/", name="EvocatioPosBundle_BasketIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {

        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPosBundle:Purchase")->find(1);

        return array("entity" => $entity);
    }

    /**
     * Finds and displays a basket entity.
     *
     * @Route("/show", name="EvocatioPosBundle_BasketShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction() {

        $entity = $this->getBasketFromSession();

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

//        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity
//            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * Finds and displays all baskets for admin.
     *
     * @Route("/list", name="EvocatioPosBundle_BasketList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {

        $entity = $this->getBasketFromSession();

        return array("entity" => $entity);
    }

    /**
     * @Route("/reset", name="EvocatioPosBundle_BasketReset")
     * @Method("GET")
     * @Template
     */
    public function resetAction() {

        $this->container->get("session")->set("basket", new Entity());

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_BasketEdit'));
    }

//
//    /**
//     * Creates a new basket entity.
//     *
//     * @Route("/new", name="EvocatioPosBundle_BasketCreate")
//     * @Method("POST")
//     * @Template("EvocatioPosBundle:Basket:new.html.twig")
//     */
//    public function createAction() {
//
//        $edit_form = $this->createBasketForm(new Entity());
//        $edit_form->bindRequest($this->container->get('Request'));
//
//        if ($this->saveToSession($edit_form) === true) {
//            $this->container->get("session")->getFlashBag()->add("success", "create.success");
//
//            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_BasketList'));
//        }
//
//        $this->container->get("session")->getFlashBag()->add("error", "create.error");
//        return array(
//            'edit_form' => $edit_form->createView()
//        );
//    }

    /**
     * @Route("/new", name="EvocatioPosBundle_BasketCreate")
     * @Route("/edit", name="EvocatioPosBundle_BasketEdit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction() {
//        $this->container->get("session")->set("basket", null);
        $entity = $this->getBasketFromSession();

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }
        $edit_form = $this->createBasketForm($entity);
//        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
//            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/new", name="EvocatioPosBundle_BasketCreate")
     * @Route("/edit", name="EvocatioPosBundle_BasketUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("EvocatioPosBundle:Basket:edit.html.twig")
     */
    public function updateAction() {

        $entity = $this->getBasketFromSession();
        $basket_post = $this->container->get('Request')->get("evocatio_bundle_posbundle_baskettype");
echo "mets en ";
        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }
        $edit_form = $this->createBasketForm($entity);
        $edit_form->bind($basket_post);

        if ($this->saveToSession($edit_form) === true) {
            $this->container->get("session")->getFlashBag()->add("success", "update.success");

//            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_BasketList'));
        }
//        $this->container->get("session")->getFlashBag()->add("error", "update.error");

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
//            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Finds and displays all baskets for admin.
     *
     * @Route("/purchase", name="EvocatioPosBundle_BasketPurchase")
     * @Method("GET")
     * @Template()
     */
    public function purchaseAction() {

        $entity = $this->getBasketFromSession();
//        $entity = new Entity();

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createPurchaseForm($entity);
//        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
//            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/confirmPurchase", name="EvocatioPosBundle_BasketConfirmPurchase")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("EvocatioPosBundle:Basket:purchase.html.twig")
     */
    public function confirmPurchaseAction() {

        $entity = $this->getBasketFromSession();

        $purchase_post = $this->container->get('Request')->get("evocatio_bundle_posbundle_purchasetype");

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $edit_form = $this->createPurchaseForm($entity);

        $edit_form->bind($purchase_post);
        if ($this->processPurchaseForm($edit_form) === true) {
            $this->container->get("session")->getFlashBag()->add("success", "update.success");
            return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_BasketPayment'));
        }
        $this->container->get("session")->getFlashBag()->add("error", "update.error");

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
//            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * Start payment workflow.
     *
     * @Route("/{id}/state", name="EvocatioPosBundle_BasketToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {

        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioPosBundle:Basket', $id);

        if (!$entity) {
            throw new NotFoundHttpException("Basket non trouvé");
        }
        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

//
//    /**
//     * Deletes a basket entity.
//     *
//     * @Route("/{id}/delete", name="EvocatioPosBundle_BasketDelete")
//     * @Method("POST")
//     */
//    public function deleteAction($id) {
//
//        $em = $this->container->get('Doctrine')->getEntityManager();
//        $entity = $em->getRepository("EvocatioPosBundle:Basket")->find($id);
//
//        if (!$entity) {
//            throw new NotFoundHttpException('entity.not.found');
//        }
//
//        $em->remove($entity);
//        $em->flush();
//
//        return new RedirectResponse($this->container->get('router')->generate('EvocatioPosBundle_BasketList'));
//    }
//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param basket $entity
     * @return Form or RedirectResponse   if validation error
     */
    protected function createBasketForm($entity) {

        $edit_form = $this->container->get('form.factory')->create(new Form(), $entity);

        return $edit_form;
    }

    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param basket $entity
     * @return Form or RedirectResponse   if validation error
     */
    protected function createPurchaseForm($entity) {

        $edit_form = $this->container->get('form.factory')->create(new \Evocatio\Bundle\PosBundle\Form\PurchaseType(), $entity);

        return $edit_form;
    }

//    /**
//     *  Create the simple delete form
//     * @param integer $id
//     * @return form
//     */
//    protected function createDeleteForm($id) {
//
//        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
//                        ->add('id', 'hidden')
//                        ->getForm()
//        ;
//    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $edit_form
     * @return true or form
     */
    protected function saveToSession($edit_form) {

        if ($edit_form->isValid()) {
            $entity = $edit_form->getData();

            $em = $this->container->get('doctrine')->getEntityManager();

//            $entity->removePurchaseProduct($entity->getPurchaseProducts()->first());
            $em->detach($entity);
            $this->container->get("session")->set("basket", $entity);

            return true;
        }

        return $edit_form;
    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $edit_form
     * @return true or form
     */
    protected function processPurchaseForm($edit_form) {

        if ($edit_form->isValid()) {
            $entity = $edit_form->getData();
////              update purchase and purchase product here for price taxes and other
//            foreach ($entity->getPurchaseProducts() as $pp) {
//                $pp->setPurchase($entity);
//                echo $pp->getId();
//            }
            $em = $this->container->get('doctrine')->getEntityManager();

            $em->persist($entity);
            $em->flush();
//            detach to put the new information back in the session.

            $this->saveToSession($edit_form);

            return true;
        }

        return $edit_form;
    }

    private function getBasketFromSession() {

        if (!$entity = $this->container->get("session")->get("basket")) {
            return new Entity();
        }
        $em = $this->container->get("doctrine")->getEntityManager();



        echo "<p>STATE_MANAGED: " . \Doctrine\ORM\UnitOfWork::STATE_MANAGED . "</p>";
        echo "<p>STATE_REMOVED: " . \Doctrine\ORM\UnitOfWork::STATE_REMOVED . "</p>";
        echo "<p>STATE_DETACHED: " . \Doctrine\ORM\UnitOfWork::STATE_DETACHED . "</p>";
        echo "<p>STATE_NEW: " . \Doctrine\ORM\UnitOfWork::STATE_NEW . "</p>";
        echo "<p>STATE_REMOVED: " . \Doctrine\ORM\UnitOfWork::STATE_REMOVED . "</p>";


        echo "<p>" . $em->getUnitOfWork()->getEntityState($entity) . "</p>";
        
//        If the state is detached for the entity, then merge
//        if ($em->getUnitOfWork()->getEntityState($entity) == 3) {
            $entity = $em->merge($entity);
//        }
//        else{
//                    $entity->getPurchaseProducts()->map(function($line_item) use ($em) {
//
//                    if ($line_item->getProduct() != NULL) {
//                            $product = $em->getRepository("EvocatioPosBundle:Product")->find($line_item->getProduct()->getId());
//                            $line_item->setProduct($product);
//                            $line_item->setPrice($line_item->getProduct()->getPrice());
//                        }
//                    });
//        }
        echo "<p>" . $em->getUnitOfWork()->getEntityState($entity) . "</p>";





//        die();
//        $entity = $em->merge($entity);

        return $entity;
    }

}
