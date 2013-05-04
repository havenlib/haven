<?php

namespace Evocatio\Bundle\WebBundle\Repository;

use \Evocatio\Bundle\CoreBundle\Generic\StatusRepository;
use \Doctrine\ORM\QueryBuilder;
use Evocatio\Bundle\WebBundle\Entity\Post;

/**
 * Description of PostRepository
 *
 * @author lbreleur
 */
class PostRepository extends StatusRepository {

    private $query_builder;

    public function getQueryBuilder() {
        return $this->query_builder;
    }

    public function setQueryBuilder(\Doctrine\ORM\QueryBuilder $query_builder) {
        $this->query_builder = $query_builder;
    }

    public function findAll() {
        $this->query_builder = $this->createQueryBuilder("e");
        return $this->getResult();
    }

    public function findAllPublished() {
        $this->query_builder = $this->filterByStatus(Post::STATUS_PUBLISHED)->getQueryBuilder();
        return $this->getResult();
    }

    public function findLastPublished($limit = null) {
        $this->query_builder = $this->filterByStatus(Post::STATUS_PUBLISHED)->getQueryBuilder();
        return $this->getResult();
    }

    private function filterByStatus($status) {
        if (is_null($this->query_builder))
            $this->query_builder = $this->createQueryBuilder("e");

        $this->query_builder->andWhere("e.status = :status");
        $this->query_builder->setParameter("status", $status);

        return $this;
    }

    public function getResult() {
        $query = $this->query_builder->getQuery();
        return $query->getResult();
    }

    /**
     * Return a query for last crated post.
     * 
     * @param boolean $return_qb
     * @param \Doctrine\ORM\QueryBuilder $query_builder
     * @return type
     */
    public function findLastCreatedOnline($qt = null) {
        $query_builder = $this->createQueryBuilder("e");
        $query_builder->orderBy("e.created_at", "ASC")
                ->setMaxResults($qt);
        $query_builder = $this->filterOnlines($query_builder);


        return $query_builder->getQuery()->getResult();
    }

}

?>
