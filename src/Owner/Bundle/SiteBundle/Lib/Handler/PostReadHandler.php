<?php

namespace Owner\Bundle\SiteBundle\Lib\Handler;

use Haven\Bundle\WebBundle\Lib\Handler\PostReadHandler as BasePostReadHandler;

class PostReadHandler extends BasePostReadHandler {

    public function getOneRandomPublished() {
        $entities = $this->em->getRepository("HavenWebBundle:Post")->findRandomPublished();
        return !empty($entities) ? $entities[0] : null;
    }

}

?>
