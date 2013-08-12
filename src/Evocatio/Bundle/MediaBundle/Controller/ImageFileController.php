<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Laurent Breleur <lbreleur@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\MediaBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use \Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class ImageFileController extends ContainerAware {

    /**
     * @Route("/admin/resize/image/{id}")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function resizeAction($id) {
        $entity = $this->container->get('evocatio_media.file.read_handler')->get($id);
        $edit_form = $this->container->get("evocatio_media.image_file.form_handler")->createResizeForm($entity->getId());
        $delete_form = $this->container->get("evocatio_media.file.form_handler")->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/admin/resize/image/{id}")
     * @return RedirectResponse
     * @Method("POST")
     * @Template
     */
    public function perfomResizingAction($id) {
        $entity = $this->container->get('evocatio_media.file.read_handler')->get($id);
        $edit_form = $this->container->get("evocatio_media.image_file.form_handler")->createResizeForm($entity->getId());
        $delete_form = $this->container->get("evocatio_media.file.form_handler")->createDeleteForm($entity->getId());

        $edit_form->bind($this->container->get('Request'));
        if ($edit_form->isValid()) {
            $resizeResult = $this->container->get("evocatio_media.image_file.manipulator")->resize($entity, $edit_form->get("width")->getData(), $edit_form->get("height")->getData());

            if ($resizeResult instanceof \Evocatio\Bundle\MediaBundle\Entity\ImageFile) {
                $this->container->get("evocatio_media.file.persistence_handler")->save($resizeResult);
                $this->container->get("session")->getFlashBag()->add("success", "resize.success");
                return new RedirectResponse($this->container->get('router')->generate($this->container->get("request")->get("_route"), array(
                            'id' => $resizeResult->getId())));
            }
        }

        $this->container->get("session")->getFlashBag()->add("error", "resize.error");

        $template = str_replace(":perfomResizing.html.twig", ":resize.html.twig", $this->container->get("request")->get('_template'));
        $params = array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );

        return new Response($this->container->get('templating')->render($template, $params));
    }
    
    /**
     * @Route("/admin/show/image/{id}")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function showAction($id){
        $entity = $this->container->get('evocatio_media.file.read_handler')->get($id);

        return array(
            'entity' => $entity
                );
    }

}
