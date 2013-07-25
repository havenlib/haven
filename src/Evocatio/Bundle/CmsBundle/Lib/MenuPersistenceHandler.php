<?php

namespace Evocatio\Bundle\CmsBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\NestedSet\Manager as NestedSetManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MenuPersistenceHandler {

    protected $em;
    protected $security_context;
    protected $nsm;
    protected $read_handler;

    public function __construct(MenuReadHandler $read_handler, EntityManager $em, SecurityContext $security_context, NestedSetManager $nsm) {
        $this->em = $em;
        $this->security_context = $security_context;
        $this->read_handler = $read_handler;
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

    public function delete($id) {

        $entity = $this->read_handler->get($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $node = $this->nsm->wrapNode($entity);
        $node->delete();
    }

}

?>
