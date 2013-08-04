<?php

namespace Evocatio\Bundle\CmsBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MenuRepository extends EntityRepository {

    private $query_builder;

    public function __construct($em, \Doctrine\ORM\Mapping\ClassMetadata $class) {
        parent::__construct($em, $class);
        $this->query_builder = $this->createQueryBuilder("m")
                        ->leftJoin("m.translations", "t")
                        ->leftJoin("t.trans_lang", "tl");
    }

    public function findRootMenus() {
        $this->filterByRoot();

        return $this->query_builder->getQuery()->getResult();
    }

    public function getQueryBuilder() {

        return $this->query_builder;
    }

    private function filterByRoot() {

        $this->query_builder->andWhere("m.id = m.root");

        return $this;
    }

}
