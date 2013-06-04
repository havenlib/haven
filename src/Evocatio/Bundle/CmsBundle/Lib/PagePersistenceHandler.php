<?php

namespace Evocatio\Bundle\CmsBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class PagePersistenceHandler {

    protected $em;
    protected $security_context;

    public function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function save($entity) {
        foreach ($entity->getPageContents() as $page_content) {
            $page_content->setArea($page_content->getContent()->getArea());
        }

        $this->em->persist($entity);
        $this->em->flush();
    }

}

?>
