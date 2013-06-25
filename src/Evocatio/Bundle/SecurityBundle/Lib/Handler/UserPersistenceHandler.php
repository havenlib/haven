<?php

namespace Evocatio\Bundle\SecurityBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Evocatio\Bundle\SecurityBundle\Entity\UserReset;

class UserPersistenceHandler {

    protected $em;
    protected $security_context;
    protected $encoder_factory;

    public function __construct(EntityManager $em, SecurityContext $security_context, EncoderFactory $encoder_factory) {
        $this->em = $em;
        $this->security_context = $security_context;
        $this->encoder_factory = $encoder_factory;
    }

    public function save($entity) {

        if (0 !== strlen($password = $entity->getPlainPassword())) {
            $encoder = $this->encoder_factory->getEncoder($entity);
            $entity->setPassword($encoder->encodePassword($password, $entity->getSalt()));
        }
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function saveWithReset($entity) {
        if (0 !== strlen($password = $entity->getPlainPassword())) {
            $encoder = $this->encoder_factory->getEncoder($entity);
            $entity->setPassword($encoder->encodePassword($password, $entity->getSalt()));
        }

        $this->removeOldReset($entity);

        $reset = new UserReset();
        $reset->setUser($entity);

        $this->em->persist($entity);
        $this->em->persist($reset);
//        $this->em->flush();

        return $reset;
    }

    public function removeOldReset($entity) {
        $resets = $this->em->createQuery("SELECT ur FROM EvocatioSecurityBundle:UserReset ur WHERE ur.user = :id")
                ->setParameter("id", $entity->getId())
                ->getResult();

        foreach ($resets as $reset) {
            $this->em->remove($reset);
        }

        $this->em->flush();
    }

}

?>
