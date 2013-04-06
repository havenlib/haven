<?php

namespace Evocatio\Bundle\CoreBundle\Lib;

use Evocatio\Bundle\CoreBundle\Entity\Language;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class LanguageReadHandler {

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function get($id) {

        $entity = $this->em->getRepository("EvocatioCoreBundle:Language")->find($id);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    public function getAll() {
        return $this->em->getRepository("EvocatioCoreBundle:Language")->findAll();
    }

    public function getPublished() {
        return $this->em->getRepository("EvocatioCoreBundle:Language")->findPublished();
    }

}

?>
