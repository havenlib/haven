<?php

namespace Evocatio\Bundle\PortfolioBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PortfolioPersistenceHandler{

    protected $em;
    protected $security_context;
    protected $read_handler;

    public function __construct(PortfolioReadHandler $read_handler, EntityManager $em, SecurityContext $security_context) {
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
