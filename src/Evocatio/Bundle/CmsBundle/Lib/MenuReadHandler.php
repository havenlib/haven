<?php

namespace Evocatio\Bundle\CmsBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;

class MenuReadHandler {

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function get($id) {

        $entity = $this->em->getRepository("EvocatioCmsBundle:Menu")->find($id);

        return $entity;
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
