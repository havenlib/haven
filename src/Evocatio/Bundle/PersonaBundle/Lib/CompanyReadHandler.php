<?php

namespace Evocatio\Bundle\PersonaBundle\Lib;

class CompanyReadHandler extends PersonaReadHandler {

    protected function getEntityClass() {
        return "Evocatio\Bundle\PersonaBundle\Entity\Company";
    }

}

?>
