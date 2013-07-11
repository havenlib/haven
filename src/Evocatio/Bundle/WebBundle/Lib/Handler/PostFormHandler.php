<?php

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Evocatio\Bundle\CoreBundle\Lib\Handler\FormHandler;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\FormFactory;
use Evocatio\Bundle\WebBundle\Entity\Post as Entity;
use Evocatio\Bundle\WebBundle\Form\PostType as Type;

class PostFormHandler extends FormHandler {

    public function createNewForm($data = null) {
        return $form = $this->doCreate($this->getDefaultTypeClass(), $data);
    }

    /**
     * @return Form 
     */
    public function createRankForm() {
        $entities = $this->read_handler->getAllOrderedByRank();
        return $form = $this->doCreate("Evocatio\Bundle\WebBundle\Form\PostCollectionType", array('posts' => $entities));
    }

    public function getDefaultTypeClass() {
        return 'Evocatio\Bundle\WebBundle\Form\PostType';
    }

}

?>
