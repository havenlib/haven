<?php

namespace Evocatio\Bundle\PortfolioBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class SheetPersistenceHandler {

    protected $em;
    protected $security_context;

    public function __construct(SheetReadHandler $read_handler, EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
        $this->read_handler = $read_handler;
    }

    public function batchSave($entities) {
        foreach ($entities as $entity) {
            $this->em->persist($entity);
        }
        $this->em->flush();
    }

    public function save($entity) {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function delete($id) {
        $entity = $this->read_handler->get($id);
        $this->em->remove($entity);
        $this->em->flush();
    }

}

?>
