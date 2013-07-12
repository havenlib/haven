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

    public function getDefaultTypeClass() {
        return 'Evocatio\Bundle\WebBundle\Form\PostType';
    }

}

?>
