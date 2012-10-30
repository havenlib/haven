<?php

namespace Evocatio\Bundle\PostBundle\Entity;

use \Evocatio\Bundle\CoreBundle\Generic\StatusRepository;
use \Doctrine\ORM\QueryBuilder;

/**
 * Description of PostRepository
 *
 * @author lbreleur
 */
class PostRepository extends StatusRepository {

    /**
     * Return a query for last crated post.
     * 
     * @param boolean $return_qb
     * @param \Doctrine\ORM\QueryBuilder $query_builder
     * @return type
     */
    public function findLastCreatedOnline($qt = null) {
        $query_builder = $this->findOnlines(true)
                ->orderBy("e.created_at", "ASC")
                ->setMaxResults($qt);

        return $query_builder->getQuery();
    }

}

?>
