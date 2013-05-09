<?php

namespace tahua\SiteBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CmsPageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CmsPageRepository extends EntityRepository
{
    
    public function findPageWithContent($page_name, $lang){
        $query_builder = $this->createQueryBuilder("p");
        $query_builder->select("p, c, ct")
                      ->leftJoin("p.cms_contents", "c")
                      ->leftJoin("c.translations", "ct")
//                      ->where("p.nom = :page_name")
                      ->andWhere("ct.lang = :lang")
                      ->andWhere("c.actif = 1")
                      ->setParameter("lang", $lang)
//                      ->setParameter("page_name", $page_name)
                      ;
        $page = $query_builder->getQuery()->getOneOrNullResult();
        $page = (!is_null($page))? $page: new CmsPage();
        
        return $page;
    }
    

}