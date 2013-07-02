<?php

namespace Owner\Bundle\SiteBundle\Lib\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Evocatio\Bundle\CoreBundle\Lib\Handler\PersistenceHandler;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

class EmployeePersistenceHandler extends PersistenceHandler {

    protected $encoder_factory;

    public function __construct(\Doctrine\ORM\EntityManager $em, SecurityContext $security_context, EncoderFactory $encoder_factory) {
        parent::__construct($em, $security_context);
        $this->encoder_factory = $encoder_factory;
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

}

?>
