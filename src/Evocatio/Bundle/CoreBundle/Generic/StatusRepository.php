<?php

namespace Evocatio\Bundle\CoreBundle\Generic;

use Doctrine\ORM\EntityRepository;
use \Doctrine\DBAL\Query\QueryBuilder;

/**
 * Evocatio\Bundle\CoreBundle\Generic\StatusRepository

 */
class StatusRepository extends EntityRepository {

    /**
     * returns builder for find one entity with the translations for languages that have status publish(1) or draft(2)
     *
     * @param integer $id
     * @return doctrine_query_builder
     */
    protected function getQBuilderBaseEditables($id) {
        $query_builder = $this->createQueryBuilder("entity")
                ->select('entity') //, 'trans')
//                ->leftjoin('entity.translations', 'trans')
//                ->join('trans.trans_lang', 'language', \Doctrine\ORM\Query\Expr\join::WITH, "language.status in (1, 2)")
                ->where("entity.id = :id")
//                ->andWhere("language.status in (1, 2)")
                ->setParameter('id', $id);
        return $query_builder;
    }

    public function findOneEditables($id) {
        return $this->getQBuilderBaseEditables($id)
                        ->getQuery()->getOneOrNullResult();
    }

    /**
     * Find all entities actualy online(status = 1). If $return_qb is set to true
     * the current QueryBuilder will be returned allow to link queries else return a query. 
     * 
     * @param boolean $return_qb
     * @param \Doctrine\DBAL\Query\QueryBuilder $query_builder
     * @return type
     */
    public function findOnlines($return_qb = false, \Doctrine\ORM\QueryBuilder $query_builder = null) {

        if (!$query_builder)
            $query_builder = $this->createQueryBuilder('e');

        $query_builder->andWhere("e.status = 1");
        return ($return_qb) ? $query_builder : $query_builder->getQuery();
    }

}