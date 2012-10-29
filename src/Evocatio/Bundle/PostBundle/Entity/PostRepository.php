<?php

namespace Evocatio\Bundle\PostBundle\Entity;

use \Evocatio\Bundle\CoreBundle\Generic\StatusRepository;

/**
 * Description of PostRepository
 *
 * @author lbreleur
 */
class PostRepository extends StatusRepository {

    /**
     * 
     * @return type
     * Return a query for last crated news.
     */
    public function findLastCreated() {
        $query_builder = $this->createQueryBuilder('p');
        $query = $query_builder->orderBy("p.created_at", "ASC")->getQuery();

        return $query;
    }

}

?>
