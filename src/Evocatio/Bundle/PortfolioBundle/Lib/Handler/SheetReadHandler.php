<?php

namespace Evocatio\Bundle\PortfolioBundle\Lib\Handler;

use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class SheetReadHandler extends ReadHandler {

    public function getAllPublished() {
        return $this->em->getRepository("EvocatioPortfolioBundle:Sheet")->findAllPublished();
    }

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\PortfolioBundle\Entity\Sheet";
    }

}

?>
