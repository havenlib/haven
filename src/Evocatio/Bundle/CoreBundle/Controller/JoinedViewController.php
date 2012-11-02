<?php

namespace Evocatio\Bundle\CoreBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class JoinedViewController extends ContainerAware {

    protected $base_class = null;

    /**
     * @Route("/", name="EvocatioCoreBundle_JoinedIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("Doctrine")->getRepository($this->getEntityClass())->findAll();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays a persona entity.
     *
     * @Route("/{id}/show", name="EvocatioCoreBundle_JoinedShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository($this->getEntityClass())->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        return array(
            'entity' => $entity
        );
    }

    /**
     * Return a new entity, based on discriminator parameter. 
     * Read the dicrminator map of the base joined entity, check if 
     * the discriminator parameter exist in this map and create an 
     * new entity based on the corresponding class else return the 
     * base joined entity.
     * 
     * @param type $discriminator
     * @return type
     * 
     */
    protected function getEntity($discriminator = null) {

        if ($this->base_class == null) {
            throw new \Exception("Base class necessary in controller");
        }

        $base_class = $this->base_class;
        $discriminator_map = $base_class::getDiscriminatorMap();

        return (!empty($discriminator_map->value[$discriminator])) ? new $discriminator_map->value[$discriminator] : $base_class;
    }

    private function getEntityClass() {
        return get_class($this->getEntity());
    }

}
