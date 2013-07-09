<?php

namespace Evocatio\Bundle\PortfolioBundle\Lib\Handler;

use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class PortfolioReadHandler extends ReadHandler {

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\PortfolioBundle\Entity\Foglio";
    }
}

?>
