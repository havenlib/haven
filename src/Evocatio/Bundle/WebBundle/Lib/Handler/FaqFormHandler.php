<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Stéphan Champagne <sc@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\WebBundle\Lib\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\WebBundle\Lib\Handler\FaqReadHandler;
use Symfony\Component\Form\FormFactory;

class FaqFormHandler {

    protected $read_handler;
    protected $form_factory;
    protected $security_context;

    public function __construct(FaqReadHandler $read_handler, SecurityContext $security_context, FormFactory $form_factory) {
        $this->read_handler = $read_handler;
        $this->form_factory = $form_factory;
        $this->security_context = $security_context;
    }

    public function createEditForm($id) {
        $entity = $this->read_handler->get($id);
        return $form = $this->doCreate('Evocatio\Bundle\WebBundle\Form\FaqType', $entity);
    }

    public function createNewForm() {
        return $form = $this->doCreate('Evocatio\Bundle\WebBundle\Form\FaqType');
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
    /**
     * Create the simple delete form
     * @param integer $id
     * should create an abstract form handler that whould have that one already
     * @return form
     */
    public function createRankForm($id, $rank) {
        return $this->form_factory->createBuilder('form', array('id' => $id, 'rank' => $rank))
                        ->add('id', 'hidden')
                        ->add('rank')
                        ->add('perform.ranking', 'submit')
                        ->getForm()
        ;
    }

}

?>
