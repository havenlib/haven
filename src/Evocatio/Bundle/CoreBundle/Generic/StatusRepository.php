<?php

namespace Evocatio\Bundle\CoreBundle\Generic;

use Doctrine\ORM\EntityRepository;

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

    public function findOneEditables($id){
        return $this->getQBuilderBaseEditables($id)
        ->getQuery()->getOneOrNullResult();
    }

    public function findOnlines(){
        return $this->findBy(array("status"=>1));
    }

}