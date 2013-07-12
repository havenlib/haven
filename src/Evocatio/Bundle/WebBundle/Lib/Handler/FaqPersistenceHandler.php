<?php

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Evocatio\Bundle\CoreBundle\Lib\Handler\PersistenceHandler;

class FaqPersistenceHandler extends PersistenceHandler {

    public function rank($entity, $new_rank) {

        $entities = $this->em->getRepository('EvocatioWebBundle:Faq')->findAllFromRank($new_rank, $old_rank = $entity->getRank(), $entity->getId());
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
        $this->em->getConnection()->exec("UPDATE Faq AS p, (SELECT MAX(rank) AS rank  FROM Faq) p2 SET p.rank = p2.rank + 1 WHERE p.id = " . $entity->getId());
    }
}

?>
