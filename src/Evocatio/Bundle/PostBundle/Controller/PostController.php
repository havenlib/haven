<?php

namespace Evocatio\Bundle\PostBundle\Controller;

// Symfony includes
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;
// Sensio includes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// Evocatio includes
use Evocatio\Bundle\PostBundle\Form\PostType as Form;
use Evocatio\Bundle\PostBundle\Entity\Post as Entity;
use Evocatio\Bundle\PostBundle\Entity\PostTranslation as EntityTranslation;

class PostController extends ContainerAware {

    /**
     * @Route("/post/", name="EvocatioPostBundle_PostIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $entities = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findOnlines();

        return array("entities" => $entities);
    }

    /**
     * Finds and displays a post entity.
     *
     * @Route("/admin/post/{id}/show", name="EvocatioPostBundle_PostShow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findOneBy(array('id' => $id));

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity
            , "delete_form" => $delete_form->createView()
        );
    }

    /**
     * Finds and displays all posts for admin.
     *
     * @Route("/admin/post/list", name="EvocatioPostBundle_PostList")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $entities = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findAll();
//        echo "default : " .\Evocatio\Bundle\CoreBundle\Lib\Locale::getDefault();
        return array("entities" => $entities);
    }

    /**
     * @Route("/admin/post/new", name="EvocatioPostBundle_PostNew")
     * @Method("GET")
     * @Template
     */
    public function newAction() {
        $edit_form = $this->createEditForm(new Entity());

        return array("edit_form" => $edit_form->createView());
    }

    /**
     * Creates a new post entity.
     *
     * @Route("/admin/post/new", name="EvocatioPostBundle_PostCreate")
     * @Method("POST")
     * @Template("EvocatioPostBundle:Post:new.html.twig")
     */
    public function createAction() {
        $edit_form = $this->createEditForm(new Entity());

        $edit_form->bindRequest($this->container->get('Request'));

        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "create.success");

            return new RedirectResponse($this->container->get('router')->generate('EvocatioPostBundle_PostList'));
        }

        $this->container->get("session")->setFlash("error", "create.error");
        return array(
            'edit_form' => $edit_form->createView()
        );
    }

    /**
     * @Route("/admin/post/{id}/edit", name="EvocatioPostBundle_PostEdit")
     * @return RedirectResponse
     * @Method("GET")
     * @Template
     */
    public function editAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findOneEditables($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }
        $edit_form = $this->createEditForm($entity);
        $delete_form = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    /**
     * @Route("/admin/post/{id}/edit", name="EvocatioPostBundle_PostUpdate")
     * @return RedirectResponse
     * @Method("POST")
     * @Template("EvocatioPostBundle:Post:edit.html.twig")
     */
    public function updateAction($id) {
        $entity = $this->container->get("Doctrine")->getRepository("EvocatioPostBundle:Post")->findOneEditables($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }


        $edit_form = $this->createEditForm($entity);
        $delete_form = $this->createDeleteForm($id);

        $files_from_post = $this->container->get("request")->files->get($edit_form->getName());
        $parameters = $this->container->get("request")->request->all();
        echo "<pre>";
//        $test = array();
//        echo "ffp: " . print_r(
//                );
        
                $result = $this->recurse($this->container->get("request")->files->all());
        
        echo "<br />-----------------> result";
        print_r($result);
        echo "<br />-----------------> all";
        print_r($parameters);
        echo "<br />-----------------> final array";
        print_r(array_merge_recursive($parameters['evocatio_bundle_postbundle_posttype']['translations'][0], $result['evocatio_bundle_postbundle_posttype']['translations'][0]));
        die();
//        foreach ($files_from_post['translations'] as $key => $files_tranlations) {
//            foreach ($files_tranlations['file'] as $file) {
//                if ($file) {
//                    $test["file_type"][] =  array(
//                        'name' => $file->getClientOriginalName(),
//                        'size' => $file->getSize(),
//                        'path' => $this->container->get("uploader")->moveFile($file, 'testhome')
//                    );
//                }
//            }
//        }

        $this->container->get("request")->request->add($parameters);
        $edit_form->bindRequest($this->container->get('Request'));


        if ($this->processForm($edit_form) === true) {
            $this->container->get("session")->setFlash("success", "update.success");
            print_r(($this->container->get("request")->files->all()));
            print_r(($this->container->get("request")->request->all()));


            $this->container->get("request")->request->add();
            print_r(($this->container->get("request")->request->all()));

            echo "</pre>";
//            return new RedirectResponse($this->container->get('router')->generate('EvocatioPostBundle_PostList'));
        }

        $this->container->get("session")->setFlash("error", "update.error");

        return array(
            'entity' => $entity,
            'edit_form' => $edit_form->createView(),
            'delete_form' => $delete_form->createView(),
        );
    }

    private function recurse($array) {
        $result = null;
        foreach ($array as $key => $data) {
            if ($data instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                $result[$this->getMimeType($data->getMimeType())][] = array(
                    'name' => $data->getClientOriginalName(),
                    'size' => $data->getSize(),
                    'path' => $this->container->get("uploader")->moveFile($data, 'testhome')
                );
            } else if (is_array($data)) {
                $temp = $this->recurse($data);
                if (!empty($temp)) {
                    if ($key === "file") {
//                        done mon chemin à levenement fin recurse($mon emplacement en string)
                        $result = $temp;
                    } else {
                        echo $key;
                        $result[$key] = $temp;
                    }
                }
            }
        }
//            echo print_r(array_keys($result));
        return $result;
    }

    public function getMimeType($mime_type) {
        switch ($mime_type) {
            case "image/jpeg":
                return "image";
                break;
            case "application/pdf":
                return "pdf";
                break;
            case "text/plain":
                return "text";
                break;
            default:
                return "other";
                break;
        }
    }

    /**
     * Set a post entity state to inactive.
     *
     * @Route("/post/{id}/state", name="EvocatioPostBundle_PostToggleState")
     * @Method("GET")
     */
    public function toggleStateAction($id) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $entity = $em->find('EvocatioPostBundle:Post', $id);
        if (!$entity) {
            throw new NotFoundHttpException("Post non trouvé");
        }
        $entity->setStatus(!$entity->getStatus());
        $em->persist($entity);
        $em->flush();

        return new RedirectResponse($this->container->get("request")->headers->get('referer'));
    }

    /**
     * Deletes a post entity.
     *
     * @Route("/admin/post/{id}/delete", name="EvocatioPostBundle_PostDelete")
     * @Method("POST")
     */
    public function deleteAction($id) {

        $em = $this->container->get('Doctrine')->getEntityManager();
        $entity = $em->getRepository("EvocatioPostBundle:Post")->find($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $em->remove($entity);
        $em->flush();

        return new RedirectResponse($this->container->get('router')->generate('EvocatioPostBundle_PostList'));
    }

    /**
     * @Route("/post/{slug}", name="EvocatioPostBundle_PostShowSlug")
     * @Method("GET")
     * @Template("EvocatioPostBundle:Post:show.html.twig")
     */
    public function showFromSlugAction(EntityTranslation $entityTranslation) {
//        $delete_form = $this->createDeleteForm($id);
        $locale = $this->container->get("request")->get("_locale");
        if ($entityTranslation->getTransLang()->getSymbol() != \Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale) && $entityTranslation->getParent()->getTranslationByLang(\Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale))) {
            $slug = $entityTranslation->getParent()->getTranslationByLang(\Evocatio\Bundle\CoreBundle\Lib\Locale::getPrimaryLanguage($locale))->getSlug();
            return new RedirectResponse($this->container->get('router')->generate('EvocatioPostBundle_PostShowSlug', array("slug" => $slug)));
        }
        $entity = $entityTranslation->getParent();

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $delete_form = $this->createDeleteForm($entity->getId());

        return array("entity" => $entity, 'delete_form' => $delete_form->createView()
        );
    }

    public function listWidgetAction($template = null, $qt = null) {
        $repo = $this->container->get('doctrine')->getRepository("EvocatioPostBundle:Post");
        $entities = $repo->findLastCreatedOnline($qt);


        return new Response($this->container->get('templating')->render($template ? $template : 'EvocatioPostBundle:Post:list_widget.html.twig', array('entities' => $entities)));
    }

//  ------------- Privates -------------------------------------------
    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @param post $entity
     * @return Form or RedirectResponse   if validation error
     */
    protected function createEditForm($entity) {
//        the list of language here will decide what languages will appear in the form for new or edit.
        $languages = $this->container->get('Doctrine')->getEntityManager()->getRepository("EvocatioCoreBundle:Language")->findBy(Array("status" => array(1, 2)));

        $entity->addTranslations($languages);

        $edit_form = $this->container->get('form.factory')->create(new Form(), $entity);
        return $edit_form;
    }

    /**
     *  Create the simple delete form
     * @param integer $id
     * @return form
     */
    protected function createDeleteForm($id) {
        return $this->container->get('form.factory')->createBuilder('form', array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * Validate and save form, if invalid returns form
     * @param type $edit_form
     * @return true or form
     */
    protected function processForm($edit_form) {
        if ($edit_form->isValid()) {
            $em = $this->container->get('Doctrine')->getEntityManager();
            $entity = $edit_form->getData();
            $em->persist($entity);
            $em->flush();

            return true;
        }

        return $edit_form;
    }

}
