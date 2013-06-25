<?php

namespace Evocatio\Bundle\SecurityBundle\Lib\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\Handler\FormHandler;

class UserFormHandler extends FormHandler {

    public function getDefaultTypeClass() {
        return "Evocatio\Bundle\SecurityBundle\Form\UserType";
    }

}

?>
