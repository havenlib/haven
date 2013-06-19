<?php

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class FaqReadHandler extends ReadHandler {

//
//    protected $em;
//    protected $security_context;
//
//    function __construct(EntityManager $em, SecurityContext $security_context) {
//        $this->em = $em;
//        $this->security_context = $security_context;
//    }
//
//    public function get($id) {
//
//        $entity = $this->em->getRepository("EvocatioWebBundle:Faq")->find($id);
//
//        if (!$entity)
//            throw new \Exception('entity.not.found');
//
//        return $entity;
//    }
//
//    public function getAll() {
//        return $this->em->getRepository("EvocatioWebBundle:Faq")->findAll();
//    }
//
//    public function getAllPublished() {
//        return $this->em->getRepository("EvocatioWebBundle:Faq")->findAllPublished();
//    }
    public function getAllOrderedByRank() {
        return $this->em->getRepository($this->getDefaultEntityClass())->findAllOrderedByRank();
    }

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\WebBundle\Entity\Faq";
    }

}

?>
