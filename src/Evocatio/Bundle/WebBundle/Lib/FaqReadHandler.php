<?php

namespace Evocatio\Bundle\WebBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class FaqReadHandler {

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function getOne($id) {

        $entity = $this->em->getRepository("EvocatioWebBundle:Faq")->find($id);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    public function getAll() {
        return $this->em->getRepository("EvocatioWebBundle:Faq")->findAll();
    }

    public function getAllOnline() {
        return $this->em->getRepository("EvocatioWebBundle:Faq")->findAll(1);
    }

}

?>
