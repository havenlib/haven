<?php

namespace Owner\Bundle\SiteBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class EmployeeReadHandler extends ReadHandler {

    public function getOneBySlug($slug) {

        $entity = $this->em->getRepository($this->getDefaultEntityClass())->findOneBySlug($slug);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    protected function getDefaultEntityClass() {
        return "Owner\Bundle\SiteBundle\Entity\Employee";
    }

}

?>
