<?php

namespace Evocatio\Bundle\CmsBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\NestedSet\Manager as NestedSetManager;

class MenuPersistenceHandler {

    protected $em;
    protected $security_context;
    protected $nsm;

    public function __construct(EntityManager $em, SecurityContext $security_context, NestedSetManager $nsm) {
        $this->em = $em;
        $this->security_context = $security_context;
        $config = $nsm->getConfiguration();
        $config->setClass('Evocatio\Bundle\CmsBundle\Entity\Menu');
        $this->nsm = $nsm;
    }

    public function createRootMenu($entity) {
        $entity->setType("root");
        $rootNode = $this->nsm->createRoot($entity);

        return $rootNode;
    }

    public function save($entity) {

        $this->em->persist($entity);
        $this->em->flush();
    }

}

?>
