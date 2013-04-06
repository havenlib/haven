<?php

namespace Evocatio\Bundle\WebBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Evocatio\Bundle\WebBundle\Entity\Faq;

class FaqReadHandler {

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function get($id) {

        $entity = $this->em->getRepository("EvocatioWebBundle:Faq")->find($id);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    public function getAll() {
        return $this->em->getRepository("EvocatioWebBundle:Faq")->findAll();
    }

    public function getAllPublished() {
        return $this->em->getRepository("EvocatioWebBundle:Faq")->findPublished();
    }
    
}

?>
