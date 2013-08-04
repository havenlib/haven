<?php

namespace Evocatio\Bundle\CmsBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Evocatio\Bundle\CoreBundle\Lib\Locale;
use Evocatio\Bundle\CmsBundle\Entity\PageTranslation;

/**
 * PageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PageRepository extends EntityRepository {

    protected $query_builder;

    public function __construct($em, \Doctrine\ORM\Mapping\ClassMetadata $class) {
        parent::__construct($em, $class);
        $this->query_builder = $this->createQueryBuilder("e")
                ->leftJoin("e.translations", "t")
                ->leftJoin("t.trans_lang", "tl");
    }

    public function findByLocalizedSlug($slug, $language) {
//        $this->query_builder = $this->createBaseQueryBuilder();
        $this->filterByLang($language, $this->query_builder);
        $this->filterBySlug($slug, $this->query_builder);
        $this->filterTranslationByStatus(PageTranslation::STATUS_PUBLISHED, $this->query_builder);

        return $this->query_builder->getQuery()->getOneOrNullResult();
    }

    public function getListForLang($language = null) {
        $language = $language ? $language : Locale::getPrimaryLanguage(Locale::getDefault());
        return $this->filterByLang($language)->getQueryBuilder()->getQuery()->getResult();
    }

    private function filterTranslationByStatus($status, $qb = null) {
//        $this->query_builder = ($qb) ? $qb : $this->createBaseQueryBuilder();

        $this->query_builder->andWhere("t.status = :status");
        $this->query_builder->setParameter("status", $status);

        return $this;
    }

    private function filterBySlug($slug, $qb = null) {
//        $this->query_builder = ($qb) ? $qb : $this->createBaseQueryBuilder();

        $this->query_builder->andWhere("t.slug = :slug");
        $this->query_builder->setParameter("slug", $slug);

        return $this;
    }

    private function filterByLang($lang, $qb = null) {
//        $this->query_builder = ($qb) ? $qb : $this->createBaseQueryBuilder();

        $this->query_builder
//                ->leftJoin("t.trans_lang", "tl")
                ->andWhere("tl.symbol= :language")
                ->setParameter("language", $lang)
        ;
        return $this;
    }

//    public function createBaseQueryBuilder() {
//        return $this->createQueryBuilder("e")
//                        ->leftJoin("e.translations", "t")
//        ;
//    }

    public function getQueryBuilder() {

        return $this->query_builder;
    }

}
