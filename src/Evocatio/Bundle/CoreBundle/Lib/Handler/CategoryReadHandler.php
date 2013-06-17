<?php

namespace Evocatio\Bundle\CoreBundle\Lib\Handler;

class CategoryReadHandler extends ReadHandler {

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\CoreBundle\Entity\Category";
    }

}

?>
