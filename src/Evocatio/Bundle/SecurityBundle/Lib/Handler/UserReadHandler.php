<?php

namespace Evocatio\Bundle\SecurityBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class UserReadHandler extends ReadHandler {
    public function getDefaultEntityClass(){
        return "Evocatio\Bundle\SecurityBundle\Entity\User";
    }
}

?>
