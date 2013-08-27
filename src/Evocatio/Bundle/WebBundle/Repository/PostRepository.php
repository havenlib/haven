<?php

namespace Evocatio\Bundle\WebBundle\Repository;

use \Evocatio\Bundle\CoreBundle\Generic\StatusRepository;
use Evocatio\Bundle\WebBundle\Entity\Post;
use Evocatio\Bundle\WebBundle\Entity\PostTranslation;

/**
 * Evocatio\Bundle\WebBundle\Entity\PostRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostRepository extends StatusRepository {

    private $query_builder;

    public function __construct($em, \Doctrine\ORM\Mapping\ClassMetadata $class) {
        parent::__construct($em, $class);
        $this->query_builder = $this->createQueryBuilder("e")
                        ->leftJoin("e.translations", "t")
                        ->leftJoin("t.trans_lang", "tl");
    }
    
    public function findAll() {
//        $this->query_builder = $this->createQueryBuilder("e");
        return $this->getResult();
    }

    public function findAllOrderedByRank($direction = 'ASC') {
//        $this->query_builder = $this->createQueryBuilder("e");
        $this->query_builder->orderBy('e.rank', $direction);
        return $this->getResult();
    }

    public function findAllPublished() {
        $this->filterByStatus(Post::STATUS_PUBLISHED);
        return $this->getResult();
    }

    public function findAllFromRank($new_rank, $old_rank, $id) {
//        $this->query_builder = $this->createQueryBuilder("e");

        $this->query_builder->where('(e.rank BETWEEN :new_rank AND :old_rank OR e.rank BETWEEN :old_rank AND :new_rank) AND e.id != :id');
        $this->query_builder->setParameters(array("new_rank" => $new_rank, "old_rank" => $old_rank, "id" => $id));
        $this->query_builder->orderBy('e.rank', 'ASC');

        return $this->getResult();
    }

    public function findLastPublished($limit = null) {
        $this->filterByStatus(Post::STATUS_PUBLISHED);

        if (!is_null($limit))
            $this->query_builder->setMaxResults($limit);

        return $this->getResult();
    }

    public function findByLocalizedSlug($slug, $language) {
//        $query_builder = $this->createBaseQueryBuilder();
        $this->filterByLang($language);
        $this->filterBySlug($slug);
        $this->filterTranslationByStatus(PostTranslation::STATUS_PUBLISHED);

        return $this->query_builder->getQuery()->getOneOrNullResult();
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

    private function filterByStatus($status) {
//        $this->query_builder = ($qb) ? $qb : $this->createQueryBuilder("e");

        $this->query_builder->andWhere("e.status = :status");
        $this->query_builder->setParameter("status", $status);

        return $this;
    }

    private function filterTranslationByStatus($status) {
//        $this->query_builder = ($qb) ? $qb : $this->createQueryBuilder("e");

        $this->query_builder->andWhere("t.status = :status");
        $this->query_builder->setParameter("status", $status);

        return $this;
    }

    private function filterBySlug($slug) {
//        $this->query_builder = ($qb) ? $qb : $this->createBaseQueryBuilder();

        $this->query_builder->andWhere("t.slug = :slug");
        $this->query_builder->setParameter("slug", $slug);

        return $this;
    }

    private function filterByLang($lang) {
//        $this->query_builder = ($qb) ? $qb : $this->createBaseQueryBuilder();

        $this->query_builder
//                ->leftJoin("t.trans_lang", "tl")
                ->andWhere("tl.symbol= :language")
                ->setParameter("language", $lang)
        ;
        return $this;
    }

    public function getResult() {
        $query = $this->query_builder->getQuery();
        return $query->getResult();
    }

//    public function createBaseQueryBuilder() {
//        return $this->createQueryBuilder("e")
//                        ->leftJoin("e.translations", "t")
//                        ->leftJoin("t.trans_lang", "tl")
//        ;
//    }

    /**
     * Return a query for last crated post.
     * 
     * @param boolean $return_qb
     * @param \Doctrine\ORM\QueryBuilder $query_builder
     * @return type
     */
    public function findLastCreatedOnline($qt = null) {
//        $query_builder = $this->createQueryBuilder("e");
        $this->query_builder->orderBy("e.created_at", "ASC")
                ->setMaxResults($qt);
        $this->filterOnlines();
        $this->filterTranslationByStatus(PostTranslation::STATUS_PUBLISHED);


        return $this->query_builder->getQuery()->getResult();
    }

}

?>
