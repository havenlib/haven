<?php

namespace Evocatio\Bundle\WebBundle\Lib;

use Evocatio\Bundle\WebBundle\Lib\FaqReadHandler;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\FormFactory;

class FaqFormHandler {

    protected $read_handler; // devrait être son listhandler je pense
    protected $form_factory;
    protected $security_context;

    public function __construct(FaqReadHandler $read_handler, SecurityContext $security_context, FormFactory $form_factory) {
        $this->read_handler = $read_handler;
        $this->form_factory = $form_factory;
        $this->security_context = $security_context;
    }

    /**
     * Create the simple delete form
     * @param integer $id
     * should create an abstract form handler that whould have that one already
     * @return form
     */
    public function createDeleteForm($id) {
        return $this->form_factory->createBuilder('form', array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}

?>
