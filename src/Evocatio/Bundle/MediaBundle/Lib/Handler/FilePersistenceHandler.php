<?php

namespace Evocatio\Bundle\MediaBundle\Lib\Handler;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class FilePersistenceHandler {

    protected $em;
    protected $security_context;
    protected $read_handler;

    public function __construct(FileReadHandler $read_handler, EntityManager $em, SecurityContext $security_context) {
        $this->em = $em;
        $this->security_context = $security_context;
        $this->read_handler = $read_handler;
    }

    public function saveMultiple($entities) {
        foreach ($entities as $entity) {

            if (preg_match("/image/", $entity->getMimeType())) {
                $image = new \Evocatio\Bundle\MediaBundle\Entity\ImageFile();
                $image->setFileName($entity->getFileName());
                $image->setMimeType($entity->getMimeType());
                $image->setName($entity->getName());
                $image->setSize($entity->getSize());
                $image->setPathName($entity->getPathName());
                $this->em->persist($image);
            }
        }
        $this->em->flush();
    }

    public function delete($id) {
        $entity = $this->read_handler->get($id);
        $this->em->remove($entity);
        $this->em->flush();
    }

}

?>
