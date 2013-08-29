<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Stéphan Champagne <sc@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\ORM\EntityManager;

class PostReadHandler {

    protected $em;
    protected $security_context;

    function __construct(EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
    }

    public function get($id) {

        $entity = $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Post")->find($id);

        if (!$entity)
            throw new \Exception('entity.not.found');

        return $entity;
    }

    public function getAll() {
        return $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Post")->findAll();
    }

    public function getAllPublished() {
        return $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Post")->findAllPublished();
    }

    public function getLastPublished($limit = null) {
        return $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Post")->findLastPublished($limit);
    }

    public function getAllOrderedByRank() {
        return $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Post")->findAllOrderedByRank();
    }

    public function getByLocalizedSlug($slug, $language) {
        $entity = $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Post")->findByLocalizedSlug($slug, $language);

        return $entity;
    }

    public function search($filters) {

        //Remove all empty filters
        $filters = array_filter($filters);

        return $entities = $this->em->getRepository("Evocatio\Bundle\WebBundle\Entity\Post")->search($filters);
    }

}

?>
