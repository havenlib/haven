<?php

namespace Evocatio\Bundle\PersonaBundle\Lib;

class CompanyFormHandler extends PersonaFormHandler {

    protected function getTypeClass() {
        return "Evocatio\Bundle\PersonaBundle\Form\CompanyType";
    }

}

?>
