<?php

namespace Evocatio\Bundle\CmsBundle\Lib;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Evocatio\Bundle\CoreBundle\Lib\NestedSet\Manager as NestedSetManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MenuPersistenceHandler {

    protected $em;
    protected $security_context;
    protected $nsm;
    protected $read_handler;

    public function __construct(MenuReadHandler $read_handler, EntityManager $em, SecurityContext $security_context, NestedSetManager $nsm) {
        $this->em = $em;
        $this->security_context = $security_context;
        $this->read_handler = $read_handler;
        $config = $nsm->getConfiguration();
        $config->setClass('Evocatio\Bundle\CmsBundle\Entity\Menu');
        $this->nsm = $nsm;
    }

    public function createRootMenu($entity) {
        $entity->setType("root");
        $rootNode = $this->nsm->createRoot($entity);

        return $rootNode;
    }

    public function createChildMenu($entity, $parent, $page = null) {
//        echo "<p>->" . $entity->getType() . "<-</p>";
echo "create is called";
        if ($entity->getType() == "internal") {
            $i =0;
            foreach ($entity->getTranslations() as $translation) {
                echo $i++;
                $link = new \Evocatio\Bundle\CoreBundle\Entity\InternalLink();
                $link->setRoute("EvocatioWebBundle_PageDisplaySlug");
                $link->setRouteParams(serialize(array(
                            "slug" => $page->getSlug($translation->getTransLang()->getSymbol())
                            , "_locale" => $translation->getTransLang()->getSymbol()
                        )));
                $translation->setLink($link);
//                echo "<p>->" . $page->getSlug($translation->getTransLang()->getSymbol()) . "<-</p>";
            }
        }

//        echo $parent;
//        die();
        $rootNode = $this->nsm->fetchBranch($parent);
        $rootNode->addChild($entity);

        return $rootNode;
    }

    public function save($entity, $page =null) {
 if ($entity->getType() == "internal") {
            foreach ($entity->getTranslations() as $translation) {
                $link = new \Evocatio\Bundle\CoreBundle\Entity\InternalLink();
                $link->setRoute("EvocatioWebBundle_PageDisplaySlug");
                $link->setRouteParams(serialize(array(
                            "slug" => $page->getSlug($translation->getTransLang()->getSymbol())
                            , "_locale" => $translation->getTransLang()->getSymbol()
                        )));
                $translation->setLink($link);
            }
        }
        $this->em->persist($entity);
        $this->em->flush();
    }

    public function delete($id) {
//      for some reason the links dont delete on cascade, it seems to work with normal function, not with nested set, if we do it otherwise it tries to recreate the parent.
        $entity = $this->read_handler->get($id);

        if (!$entity) {
            throw new NotFoundHttpException('entity.not.found');
        }

        $entity2 = clone $entity;

        $links = array();
        foreach ($entity->getTranslations() as $translation) {
            $links[] = $translation->getLink();
        }
        $node = $this->nsm->wrapNode($entity2);
        $node->delete();

//            $this->em->flush();
        foreach ($links as $link) {
            $this->em->remove($link);
        }
        $this->em->flush();
//            $this->em->flush()
    }

}

?>
