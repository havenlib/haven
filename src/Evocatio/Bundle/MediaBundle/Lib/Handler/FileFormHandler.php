<?php

namespace Evocatio\Bundle\MediaBundle\Lib\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\Handler\FormHandler;
use Symfony\Component\Form\FormFactory;

class FileFormHandler {

    protected $read_handler;
    protected $form_factory;
    protected $security_context;

    public function __construct(FileReadHandler $read_handler, SecurityContext $security_context, FormFactory $form_factory) {
        $this->read_handler = $read_handler;
        $this->form_factory = $form_factory;
        $this->security_context = $security_context;
    }

    public function createEditForm($id) {
        $entity = $this->read_handler->get($id);
        return $form = $this->doCreate($this->getDefaultTypeClass(), $entity);
    }

    public function createNewForm() {
        return $form = $this->doCreate('Evocatio\Bundle\MediaBundle\Form\FileType');
    }

    public function createMultipleNewForm() {
        return $form = $this->doCreate('Evocatio\Bundle\MediaBundle\Form\FilesType');
    }

    protected function doCreate($type, $entity = null) {
        $type = is_object($type) ? $type : new $type();
        return $this->form_factory->create($type, $entity);
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
                        ->add('delete', 'submit')
                        ->getForm()
        ;
    }

    protected function getDefaultTypeClass() {
        return 'Evocatio\Bundle\MediaBundle\Form\FileType';
    }

}

?>
