<?php

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class PostReadHandler extends ReadHandler {

    public function getAllPublished() {
        return $this->em->getRepository("EvocatioWebBundle:Post")->findAllPublished();
    }

    public function getLastPublished($limit = null) {
        return $this->em->getRepository("EvocatioWebBundle:Post")->findLastPublished($limit);
    }

    public function getAllOrderedByRank() {
        return $this->em->getRepository($this->getDefaultEntityClass())->findAllOrderedByRank();
    }

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\WebBundle\Entity\Post";
    }

}

?>
