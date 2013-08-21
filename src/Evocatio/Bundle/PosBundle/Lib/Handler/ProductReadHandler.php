<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Laurent Breleur <lbreleur@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\PosBundle\Lib\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityManager;

class ProductReadHandler{

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function get($id) {

        $entity = $this->em->getRepository("Evocatio\Bundle\PosBundle\Entity\Product")->find($id);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    public function getAll() {
        return $this->em->getRepository("Evocatio\Bundle\PosBundle\Entity\Product")->findAll();
    }

    public function getAllPublished() {
        return $this->em->getRepository("Evocatio\Bundle\PosBundle\Entity\Product")->findAllPublished();
    }

    public function getLastPublished($limit = null) {
        return $this->em->getRepository("Evocatio\Bundle\PosBundle\Entity\Product")->findLastPublished($limit);
    }

}

?>
