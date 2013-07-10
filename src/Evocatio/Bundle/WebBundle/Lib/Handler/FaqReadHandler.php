<?php

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class FaqReadHandler extends ReadHandler {

    public function getAllPublished() {
        return $this->em->getRepository("EvocatioWebBundle:Faq")->findAllPublished();
    }

    public function getAllOrderedByRank() {
        return $this->em->getRepository($this->getDefaultEntityClass())->findAllOrderedByRank();
    }

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\WebBundle\Entity\Faq";
    }

}

?>