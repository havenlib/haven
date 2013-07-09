<?php

namespace Owner\Bundle\SiteBundle\Lib\Handler;

use Evocatio\Bundle\WebBundle\Lib\Handler\PostReadHandler as BasePostReadHandler;

class PostReadHandler extends BasePostReadHandler {

    public function getOneRandomPublished() {
        $entities = $this->em->getRepository("EvocatioWebBundle:Post")->findRandomPublished();
        return !empty($entities) ? $entities[0] : null;
    }

}

?>
