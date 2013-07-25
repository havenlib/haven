<?php

namespace Evocatio\Bundle\PortfolioBundle\Lib\Handler;

use Evocatio\Bundle\CoreBundle\Lib\Handler\FormHandler;

class SheetFormHandler extends FormHandler {

    protected function getDefaultTypeClass() {
        return 'Evocatio\Bundle\PortfolioBundle\Form\SheetType';
    }

}

?>
