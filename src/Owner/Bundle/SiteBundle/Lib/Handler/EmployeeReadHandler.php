<?php

namespace Owner\Bundle\SiteBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class EmployeeReadHandler extends ReadHandler {

    protected function getDefaultEntityClass() {
        return "Owner\Bundle\SiteBundle\Entity\Employee";
    }

}

?>
