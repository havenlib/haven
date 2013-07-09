<?php

namespace Evocatio\Bundle\CoreBundle\Lib\Handler;

class CategoryFormHandler extends FormHandler {

    protected function getDefaultTypeClass() {
        return "Evocatio\Bundle\CoreBundle\Form\CategoryType";
    }
   
}

?>
