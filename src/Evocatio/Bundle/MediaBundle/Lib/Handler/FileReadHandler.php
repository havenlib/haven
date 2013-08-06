<?php

namespace Evocatio\Bundle\MediaBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class FileReadHandler {

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function get($id) {

        $entity = $this->em->getRepository($this->getDefaultEntityClass())->find($id);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    public function getAll() {
        return $this->em->getRepository($this->getDefaultEntityClass())->findAll();
    }

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\MediaBundle\Entity\Faq";
    }

}

?>