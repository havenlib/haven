<?php

namespace Evocatio\Bundle\PersonaBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\PersonaBundle\Entity\Person as Entity;

class PersonReadHandler extends PersonaReadHandler {

    protected function getEntityClass() {
        return "Evocatio\Bundle\PersonaBundle\Entity\Person";
    }

}

?>
