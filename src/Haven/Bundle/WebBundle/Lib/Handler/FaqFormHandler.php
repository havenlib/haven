<?php

/*
 * This file is part of the Haven package.
 *
 * (c) Stéphan Champagne <sc@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Haven\Bundle\WebBundle\Lib\Handler;

use Symfony\Component\Security\Core\SecurityContext;
use Haven\Bundle\WebBundle\Lib\Handler\FaqReadHandler;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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

//        if ($this->security_context->isGranted('ROLE_Admin')) {
            return $form = $this->form_factory->create(new \Haven\Bundle\WebBundle\Form\FaqType(), $entity);
//        }
//
//        throw new AccessDeniedException("you.dont.have.right.for.this.action");
    }

    public function createNewForm() {

//        if ($this->security_context->isGranted('ROLE_Admin')) {
            return $form = $this->form_factory->create(new \Haven\Bundle\WebBundle\Form\FaqType());
//        }
//
//        throw new AccessDeniedException("you.dont.have.right.for.this.action");
    }

    /**
     * Create the simple delete form
     * @param integer $id
     * should create an abstract form handler that whould have that one already
     * @return form
     */
    public function createDeleteForm($id) {
//        if ($this->security_context->isGranted('ROLE_Admin')) {
            return $form = $this->form_factory->createBuilder('form', array('id' => $id))
                    ->add('id', 'hidden')
                    ->add('delete', 'submit')
                    ->getForm()
            ;
//        }
//
//        throw new AccessDeniedException("you.dont.have.right.for.this.action");
    }

    /**
     * @param integer $id
     * @return form
     */
    public function createRankForm($id, $rank) {
//        if ($this->security_context->isGranted('ROLE_Admin')) {
            return $this->form_factory->createBuilder('form', array('id' => $id, 'rank' => $rank))
                            ->add('id', 'hidden')
                            ->add('rank')
                            ->add('perform.ranking', 'submit')
                            ->getForm()
            ;
//        }
    }

}

?>
