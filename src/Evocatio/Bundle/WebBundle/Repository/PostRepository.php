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

    public function findAllOrderedByRank() {
        $this->order('rank');
        return $this->getResult();
    }

    public function findAllPublished() {
        $this->filterByStatus(Post::STATUS_PUBLISHED)->getQueryBuilder();
        return $this->getResult();
    }

    public function findLastPublished($limit = null) {
        $this->filterByStatus(Post::STATUS_PUBLISHED);

        if (!is_null($limit))
            $this->limit($limit);

        return $this->getResult();
    }

    public function findOneRandomly() {
        $this->filterByStatus(Post::STATUS_PUBLISHED);
        $this->query_builder
                ->join();
        createQuery("SELECT p FROM Evocatio\Bundle\WebBundle\Entity\Post p JOIN (SELECT ROUND(MAX(ID)*RAND()) AS ID FROM Evocatio\Bundle\WebBundle\Entity\Post) AS x ON p.ID >= x.ID LIMIT 1");
//        ->createQueryBuilder("e")->join('u', 'u2', Expr\Join::WITH, 'p.is_primary = 1'); ;
//        echo $this->query_builder->join();
//                ->getQueryBuilder(); SELECT * FROM Post T JOIN (SELECT ROUND(MAX(ID)*RAND()) AS ID FROM Post) AS x ON T.ID >= x.ID LIMIT 1;
    }

    public function order($field, $direction = 'ASC') {
        if (is_null($this->query_builder))
            $this->query_builder = $this->createQueryBuilder("e");

        $this->query_builder->orderBy('e.' . $field, $direction);

        return $this;
    }

    public function limit($limit) {
        if (is_null($this->query_builder))
            $this->query_builder = $this->createQueryBuilder("e");

        $this->query_builder->setMaxResults($limit);

        return $this;
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
