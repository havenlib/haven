<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Stéphan Champagne <sc@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;

class FaqReadHandler{

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function get($id) {

        $entity = $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Faq")->find($id);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    public function getAll() {
        return $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Faq")->findAll();
    }

    public function getAllPublished() {
        return $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Faq")->findAllPublished();
    }

    public function getAllOrderedByRank() {
        return $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Faq")->findAllOrderedByRank();
    }

}

?>