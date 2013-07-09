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

    public function findAll() {
        $this->query_builder = $this->createQueryBuilder("e");
        return $this->getResult();
    }

    public function findAllOrderedByRank($direction = 'ASC') {
        $this->query_builder = $this->createQueryBuilder("e");
        $this->query_builder->orderBy('e.rank', $direction);
        return $this->getResult();
    }

    public function findAllPublished() {
        $this->filterByStatus(Post::STATUS_PUBLISHED);
        return $this->getResult();
    }

    public function findLastPublished($limit = null) {
        $this->filterByStatus(Post::STATUS_PUBLISHED);

        if (!is_null($limit))
            $this->query_builder->setMaxResults($limit);

        return $this->getResult();
    }

    public function findRandomPublished($limit = 1) {
        $max = $this->_em->createQuery('SELECT MAX(e.id) FROM EvocatioWebBundle:Post e WHERE e.status = :status')
                ->setParameter('status', Post::STATUS_PUBLISHED)
                ->getSingleScalarResult();

        $this->filterByStatus(Post::STATUS_PUBLISHED);
        $this->query_builder
                ->andWhere("e.id >= :id")
                ->orderBy("e.id", "ASC")
                ->setParameter('id', $rand = mt_rand(0, $max))
                ->setMaxResults($limit);

        return $this->getResult();
    }

//    public function order($field, $direction = 'ASC') {
//        if (is_null($this->query_builder))
//            $this->query_builder = $this->createQueryBuilder("e");
//
//        $this->query_builder->orderBy('e.' . $field, $direction);
//
//        return $this;
//    }
//    public function limit($limit) {
//        if (is_null($this->query_builder))
//            $this->query_builder = $this->createQueryBuilder("e");
//
//        $this->query_builder->setMaxResults($limit);
//
//        return $this;
//    }

    private function filterByStatus($status, $qb = null) {
        $this->query_builder = ($qb) ? $qb : $this->createQueryBuilder("e");

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
