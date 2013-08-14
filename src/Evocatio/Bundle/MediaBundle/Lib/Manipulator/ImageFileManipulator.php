<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Laurent Breleur <lbreleur@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\MediaBundle\Lib\Manipulator;

class ImageFileManipulator {

    private $root_dir;
    private $upload_dir;

    public function __construct($root_dir, $upload_dir) {
        $this->root_dir = $root_dir;
        $this->upload_dir = $upload_dir;
    }

    public function crop($entity, $width, $height, $x, $y) {
        $image = $this->imageCreateFrom($entity);
        $newPathName = str_replace($entity->getFileName(), $newFileName = str_replace(strstr($entity->getFileName(), ".", true), uniqid(), $entity->getFileName()), $entity->getPathName());

        $newImage = imagecreatetruecolor($width, $height);

        //Keep png file transparency
        if ($entity->getMimeType() == "image/png") {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            imagefilledrectangle($newImage, 0, 0, $width, $height, $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127));
        }

        $resizeSuccess = imagecopyresampled($newImage, $image, 0, 0, $x, $y, $width, $height, $entity->getWidth(), $entity->getHeight());

        if ($resizeSuccess) {
            $createSuccess = $this->createPhysicalFile($entity, $newImage, $newPath = $this->root_dir . "/" . $newPathName, 100);
            if ($createSuccess) {
                $newEntity = new \Evocatio\Bundle\MediaBundle\Entity\ImageFile();
                $newEntity->setPathName($newPathName);
                $newEntity->setName($name = $width . 'x' . $height . "_" . $entity->getName());
                $newEntity->setWidth($width);
                $newEntity->setHeight($height);
                $newEntity->setFileName($newFileName);
                $newEntity->setMimeType($entity->getMimeType());
                $newEntity->setAlt($entity->getAlt());
                $newEntity->setSize(filesize($newPath));

                return $newEntity;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function resize($entity, $width, $height) {
        $image = $this->imageCreateFrom($entity);
        $newPathName = str_replace($entity->getFileName(), $newFileName = str_replace(strstr($entity->getFileName(), ".", true), uniqid(), $entity->getFileName()), $entity->getPathName());

        $newImage = imagecreatetruecolor($width, $height);

        //Keep png file transparency
        if ($entity->getMimeType() == "image/png") {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            imagefilledrectangle($newImage, 0, 0, $width, $height, $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127));
        }

        $resizeSuccess = imagecopyresampled($newImage, $image, 0, 0, 0, 0, $width, $height, $entity->getWidth(), $entity->getHeight());

        if ($resizeSuccess) {
            $createSuccess = $this->createPhysicalFile($entity, $newImage, $newPath = $this->root_dir . "/" . $newPathName, 100);
            if ($createSuccess) {
                $newEntity = new \Evocatio\Bundle\MediaBundle\Entity\ImageFile();
                $newEntity->setPathName($newPathName);
                $newEntity->setName($name = $width . 'x' . $height . "_" . $entity->getName());
                $newEntity->setWidth($width);
                $newEntity->setHeight($height);
                $newEntity->setFileName($newFileName);
                $newEntity->setMimeType($entity->getMimeType());
                $newEntity->setAlt($entity->getAlt());
                $newEntity->setSize(filesize($newPath));

                return $newEntity;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function imageCreateFrom($entity) {
        switch ($entity->getMimeType()) {
            case "image/jpeg":
                return imagecreatefromjpeg($path = $this->root_dir . "/" . $entity->getPathName());
                break;
            case "image/png":
                return imagecreatefrompng($path = $this->root_dir . "/" . $entity->getPathName());
                break;
            default:
                throw new \Exception("You are trying to resize an unresizable file of MIME type " . $entity->getMimeType() . ". Only png, jpeg files are accepted");
                break;
        }
    }

    private function createPhysicalFile($entity, $newImage, $newPath) {
        switch ($entity->getMimeType()) {
            case "image/jpeg":
                return imagejpeg($newImage, $newPath, 100);
                break;
            case "image/png":
                return imagepng($newImage, $newPath);
                break;
            default:
                throw new \Exception("You are trying to resize an unresizable file of MIME type " . $entity->getMimeType() . ". Only png, jpeg files are accepted");
                break;
        }
    }

}

?>
