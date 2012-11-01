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
//Other includes
use Doctrine\Common\Annotations\AnnotationReader;
use \ReflectionClass;

class ProductViewController extends ContainerAware {

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

        return array(
            'entity' => $entity
        );
    }
}
