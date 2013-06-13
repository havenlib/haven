<?php

namespace Evocatio\Bundle\CmsBundle\Lib;

use Evocatio\Bundle\CoreBundle\Lib\LanguageReadHandler;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Form\FormFactory;
use Evocatio\Bundle\CmsBundle\Entity\PageContent as Entity;
use Evocatio\Bundle\CmsBundle\Form\PageContentType as Type;
use Evocatio\Bundle\CmsBundle\Entity\HtmlContent as HtmlContent;

class PageContentFormHandler {

    protected $read_handler; // devrait être son listhandler je pense
    protected $language_read_handler;
    protected $form_factory;
    protected $security_context;

    public function __construct(PageContentReadHandler $read_handler, LanguageReadHandler $language_read_handler, SecurityContext $security_context, FormFactory $form_factory) {
        $this->read_handler = $read_handler;
        $this->language_read_handler = $language_read_handler;
        $this->form_factory = $form_factory;
        $this->security_context = $security_context;
    }

    /**
     * Creates an edit_form with all the translations objects added for status languages
     * @return Form 
     */
    public function createEditForm($id) {
        $entity = $this->read_handler->get($id);
        $edit_form = $this->form_factory->create(new Type(), $entity);

        return $edit_form;
    }

    /**
     * 
     * @param \Website\Bundle\SiteBundle\Entity\Entreprise $entreprise
     * @return a form for dossier, as dossierType or DossierRequerantType
     */
    public function createNewFormForPage($page, $content_type = "HtmlContent") {
        
        $create_form = $this->createHtmlContentForm($page);

        return $create_form;
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
    public function createHtmlContentForm($page){
        $entity = new Entity();
        $temp_translation = new \Evocatio\Bundle\CmsBundle\Entity\HtmlContentTranslation();
        $temp_content = new \Evocatio\Bundle\CmsBundle\Entity\HtmlContent();
        $temp_content->addTranslation($temp_translation);
        $entity->setContent($temp_content);
        $entity->setPage($page);
        $entity->setContent($temp_content);    
        
        return $this->form_factory->create(new Type("HtmlContent"), $entity);
    }
}

?>
