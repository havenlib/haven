<?php

namespace Evocatio\Bundle\PersonaBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\PersonaBundle\Entity\Persona;

class PersonaReadHandler {

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function get($id, $discriminator = null) {

        $entity = $this->em->getRepository($this->getEntityClass($discriminator))->find($id);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    public function getAll($discriminator = null) {
        return $this->em->getRepository($this->getEntityClass($discriminator))->findAll();
    }

    public function getAllPublished($discriminator = null) {
        return $this->em->getRepository($this->getEntityClass($discriminator))->findAllPublished();
    }


    /**
     * Return the class of entity, based on discriminator parameter. 
     * Read the dicriminator map of the base joined entity, check if 
     * the discriminator parameter exist in this map and create an 
     * new entity based on the corresponding class else return the 
     * base joined entity.
     * 
     * @param type $discriminator
     * @return type
     * 
     */
    private function getEntityClass($discriminator = null) {
        $discriminator_map = Persona::getDiscriminatorMap();

        if (!in_array($discriminator, array_keys($discriminator_map->value))) {
            throw new \Exception($discriminator . " discriminator doesn't exist in " . get_class(new Persona()) . " class.");
        }
        return get_class(new $discriminator_map->value[$discriminator]);
    }

}

?>
