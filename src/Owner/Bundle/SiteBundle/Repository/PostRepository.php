<?php

namespace Owner\Bundle\SiteBundle\Repository;

use \Doctrine\ORM\QueryBuilder;
use Evocatio\Bundle\WebBundle\Repository\PostRepository as BasePostRepository;

/**
 * Description of PostRepository
 *
 * @author lbreleur
 */
class PostRepository extends BasePostRepository {

    public function findOneRandomly() {
        $this->filterByStatus(Post::STATUS_PUBLISHED);
//        $this->query_builder
//                ->join("");
//        createQuery("SELECT p FROM Evocatio\Bundle\WebBundle\Entity\Post p JOIN (SELECT ROUND(MAX(ID)*RAND()) AS ID FROM Evocatio\Bundle\WebBundle\Entity\Post) AS x ON p.ID >= x.ID LIMIT 1");
//        ->createQueryBuilder("e")->join('u', 'u2', Expr\Join::WITH, 'p.is_primary = 1'); ;
//        echo $this->query_builder->join();
//                ->getQueryBuilder(); SELECT * FROM Post T JOIN (SELECT ROUND(MAX(ID)*RAND()) AS ID FROM Post) AS x ON T.ID >= x.ID LIMIT 1;
    }

}

?>
