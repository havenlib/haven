<?php

namespace Evocatio\Bundle\PersonaBundle\Lib;

use Evocatio\Bundle\PersonaBundle\Lib\PersonaReadHandler;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\FormFactory;
use Evocatio\Bundle\PersonaBundle\Form\PersonWithCoorType;

class PersonFormHandler extends PersonaFormHandler {

    public function createNewWithCoordinateForm() {
        $new_form = $this->form_factory->create(new PersonWithCoorType());

        return $new_form;
    }

    public function createEditWithCoordinateForm($id) {
        $entity = $this->read_handler->get($id);
        $edit_form = $this->form_factory->create(new PersonWithCoorType(), $entity);

        return $edit_form;
    }

    protected function getTypeClass() {
        return "Evocatio\Bundle\PersonaBundle\Form\PersonType";
    }

}

?>
