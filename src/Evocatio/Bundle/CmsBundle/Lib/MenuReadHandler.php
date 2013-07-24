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

        $entity = $this->em->getRepository("EvocatioCmsBundle:Menu")->find($id);

        return $entity;
    }
    public function getBranch($id) {
        $test = $this->nsm->fetchBranchAsArray($id);
        
        return $test;
    }
    
    public function getAll() {
        return $this->em->getRepository("EvocatioCmsBundle:Menu")->findAll();
    }

    public function getAllPublished() {
        return $this->em->getRepository("EvocatioCmsBundle:Menu")->findAllPublished();
    }

    public function getBySlugForLanguage($slug, $language){
        $entity = $this->em->getRepository("EvocatioCmsBundle:Menu")->findByLocalizedSlug( $slug, $language);

        return $entity;        
    }
}

?>
