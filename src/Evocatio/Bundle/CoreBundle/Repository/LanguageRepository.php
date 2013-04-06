<?php

namespace Evocatio\Bundle\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;
use \Doctrine\DBAL\Query\QueryBuilder;
use Evocatio\Bundle\CoreBundle\Entity\Language;

/**
 * Evocatio\Bundle\CoreBundle\Repository\LanguageRepository
 */
class LanguageRepository extends EntityRepository {

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

    public function findPublished() {
        $this->query_builder = $this->filterByStatus(Language::STATUS_PUBLISHED)->getQueryBuilder();
        return $this->getResult();
    }

    public function findPublishedOrderedByRank($order = 'ASC') {
        $this->query_builder = $this->filterByStatus(Language::STATUS_PUBLISHED)
                ->orderByRank($order)
                ->getQueryBuilder();

        return $this->getResult();
    }

    private function filterByStatus($status) {
        if (is_null($this->query_builder))
            $this->query_builder = $this->createQueryBuilder("e");

        $this->query_builder->andWhere("e.status = :status");
        $this->query_builder->setParameter("status", $status);

        return $this;
    }

    private function orderByRank($order = 'ASC') {
        if (is_null($this->query_builder))
            $this->query_builder = $this->createQueryBuilder("e");

        $this->query_builder->orderBy("e.rank", $order);

        return $this;
    }

    public function getResult() {
        $query = $this->query_builder->getQuery();
        return $query->getResult();
    }

//    /**
//     * returns builder for find one entity with the translations for languages that have status publish(1) or draft(2)
//     *
//     * @param integer $id
//     * @return doctrine_query_builder
//     */
//    protected function getQBuilderBaseEditables($id) {
//        $query_builder = $this->createQueryBuilder("entity")
//                ->select('entity') //, 'trans')
////                ->leftjoin('entity.translations', 'trans')
////                ->join('trans.trans_lang', 'language', \Doctrine\ORM\Query\Expr\join::WITH, "language.status in (1, 2)")
//                ->where("entity.id = :id")
////                ->andWhere("language.status in (1, 2)")
//                ->setParameter('id', $id);
//        return $query_builder;
//    }
//
//    public function findOneEditables($id) {
//        return $this->getQBuilderBaseEditables($id)
//                        ->getQuery()->getOneOrNullResult();
//    }
//
//    /**
//     * Filter QueryBuilder with online.
//     * 
//     * @param \Doctrine\DBAL\Query\QueryBuilder $query_builder
//     * @return \Doctrine\DBAL\Query\QueryBuilder
//     */
//    protected function filterOnlines(\Doctrine\ORM\QueryBuilder $query_builder = null) {
//
//        if (!$query_builder)
//            $query_builder = $this->createQueryBuilder('e');
//
//        $query_builder->andWhere("e.status = 1");
//        return $query_builder;
//    }
//
//    /**
//     * Find all entities actualy online(status = 1). If $return_qb is set to true
//     * the current QueryBuilder will be returned allow to link queries else return a query. 
//     * 
//     * @return type
//     */
//    public function findOnlines() {
//        $query_builder = $this->filterOnlines();
//
//        return $query_builder->getQuery()->getResult();
//    }
//
//    /**
//     * order by rank 
//     */
//    public function findOnlinesByRank() {
//        $query_builder = $this->getQBOnlinesByRank();
//
//        return $query_builder->getQuery()->getResult();
//    }
//
//    /**
//     * order by rank 
//     */
//    public function getQBOnlinesByRank() {
//        $query_builder = $this->filterOnlines();
//        $query_builder->orderBy("e.rank");
//
//        return $query_builder;
//    }
}