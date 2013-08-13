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

class PostPersistenceHandler {

    protected $em;
    protected $security_context;
    protected $read_handler;

    public function __construct(PostReadHandler $read_handler, EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
        $this->read_handler = $read_handler;
    }

    public function save($entity) {
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function batchSave($entities) {
        foreach ($entities as $entity) {
            $this->em->persist($entity);
        }
        $this->em->flush();
    }

    public function rank($entity, $new_rank) {

        $entities = $this->em->getRepository('EvocatioWebBundle:Post')->findAllFromRank($new_rank, $old_rank = $entity->getRank(), $entity->getId());
        $rank = ($new_rank < $old_rank) ? $new_rank : $old_rank;

        foreach ($entities as $e) {
            $e->setRank(($old_rank - $new_rank > 0) ? ++$rank : $rank++);
            $this->em->persist($e);
        }

        $entity->setRank($new_rank);
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function firstSave($entity) {
        $this->em->persist($entity);
        $this->em->flush();

        /**
         * Set the default rank to max rank + 1
         */
        $this->em->getConnection()->exec("UPDATE Post AS p, (SELECT IFNULL(MAX(rank), 0) AS rank FROM Post) p2 SET p.rank = p2.rank + 1 WHERE p.id = " . $entity->getId());
    }

    public function delete($id) {
        $entity = $this->read_handler->get($id);
        $this->em->remove($entity);
        $this->em->flush();
    }

}

?>
