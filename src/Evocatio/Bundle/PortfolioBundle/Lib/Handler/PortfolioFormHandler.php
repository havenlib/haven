<?php

namespace Evocatio\Bundle\PortfolioBundle\Lib\Handler;

use Evocatio\Bundle\CoreBundle\Lib\Handler\FormHandler;

class PortfolioFormHandler extends FormHandler {

    protected function getDefaultTypeClass() {
        return 'Evocatio\Bundle\PortfolioBundle\Form\FoglioType';
    }

}

?>
