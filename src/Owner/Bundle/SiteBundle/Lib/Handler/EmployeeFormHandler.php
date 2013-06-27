<?php

namespace Owner\Bundle\SiteBundle\Lib\Handler;

use Evocatio\Bundle\CoreBundle\Lib\Handler\FormHandler;

class EmployeeFormHandler extends FormHandler {

    protected function getDefaultTypeClass() {
        return "Owner\Bundle\SiteBundle\Form\EmployeeType";
    }

}

?>
