<?php

namespace Evocatio\Bundle\PortfolioBundle\Lib\Handler;

use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class PortfolioReadHandler extends ReadHandler {

    public function getAllPublished() {
        return $this->em->getRepository("EvocatioPortfolioBundle:Projet")->findAllPublished();
    }

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\PortfolioBundle\Entity\Projet";
    }

}

?>
