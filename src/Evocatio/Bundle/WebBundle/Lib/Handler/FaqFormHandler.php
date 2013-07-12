<?php

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\Handler\FormHandler;

class FaqFormHandler extends FormHandler {

    /**
     * @return Form 
     */
    public function createRankForm() {
        $entities = $this->read_handler->getAllOrderedByRank();
        return $form = $this->doCreate("Evocatio\Bundle\WebBundle\Form\FaqCollectionType", array('faqs' => $entities));
    }

    protected function getDefaultTypeClass() {
        return 'Evocatio\Bundle\WebBundle\Form\FaqType';
    }
}

?>
