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
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Evocatio\Bundle\CoreBundle\Lib\Handler\ReadHandler;

class FaqReadHandler extends ReadHandler {

    public function getAllPublished() {
        return $this->em->getRepository("EvocatioWebBundle:Faq")->findAllPublished();
    }

    public function getAllOrderedByRank() {
        return $this->em->getRepository($this->getDefaultEntityClass())->findAllOrderedByRank();
    }

    protected function getDefaultEntityClass() {
        return "Evocatio\Bundle\WebBundle\Entity\Faq";
    }

}

?>