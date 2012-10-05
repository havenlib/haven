<?php

namespace Evocatio\Bundle\CoreBundle\Entity;

use Doctrine\ORM\EntityRepository;

use Evocatio\Bundle\CoreBundle\Generic\StatusRepository;

/**
 * Evocatio\Bundle\CoreBundle\Entity\LanguageRepository
 *
 */
class LanguageRepository extends StatusRepository {
    
    public function createNewEntity($symbol = null, $status = 0){
        $entity = new Language();
        $entity->setStatus($status);
        $entity->setSymbol($symbol);
        
        return $entity;
    }

}