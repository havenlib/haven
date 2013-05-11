<?php

namespace Evocatio\Bundle\PersonaBundle\Lib;

use Evocatio\Bundle\PersonaBundle\Lib\PersonaReadHandler;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\FormFactory;

class PersonFormHandler extends PersonaFormHandler {

    protected function getTypeClass() {
        return "Evocatio\Bundle\PersonaBundle\Form\PersonType";
    }

}

?>
