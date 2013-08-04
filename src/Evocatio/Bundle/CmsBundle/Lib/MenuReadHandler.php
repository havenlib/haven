<?php

namespace Evocatio\Bundle\CmsBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\NestedSet\Manager as NestedSetManager;

class MenuReadHandler {

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

    public function get($id) {

        $entity = $this->nsm->fetchBranch($id);

        return $entity;
    }
    public function getBranch($id) {
        $test = $this->nsm->fetchBranchAsArray($id);
        
        return $test;
    }
    
    public function getAllRootMenus() {
        $roots = $this->em->getRepository("EvocatioCmsBundle:Menu")->findRootMenus();
        $entities = array();
        foreach($roots as $root){
            $entities[] = $this->nsm->fetchTree($root->getId());
        }
        
        return $entities;
    }

}

?>
