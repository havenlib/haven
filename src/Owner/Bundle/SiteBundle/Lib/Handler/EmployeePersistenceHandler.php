<?php

namespace Owner\Bundle\SiteBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

class EmployeePersistenceHandler{

    protected $em;
    protected $security_context;
    protected $encoder_factory;
    protected $read_handler;

    public function __construct(EmployeeReadHandler $read_handler, EntityManager $em, SecurityContext $security_context, EncoderFactory $encoder_factory) {
        $this->em = $em;
        $this->security_context = $security_context;
        $this->encoder_factory = $encoder_factory;
        $this->read_handler = $read_handler;
    }

    public function batchSave($entities) {
        foreach ($entities as $entity) {
            $this->em->persist($entity);
        }
        $this->em->flush();
    }

    public function save($entity) {

        $user = $entity->getUser();
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $encoder = $this->encoder_factory->getEncoder($user);
            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
        }

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
