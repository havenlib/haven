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

    public function crop($fileName, $pathName, $mimeType, $width, $height, $newWidth, $newHeight) {
        $image = $this->createImageFrom($pathName, $mimeType);
        $newPathName = str_replace($fileName, $newFileName = str_replace(strstr($fileName, ".", true), uniqid(), $fileName), $pathName);

        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        //Keep png file transparency
        if ($mimeType == "image/png") {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127));
        }

        $resizeSuccess = imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        if (!$resizeSuccess)
            return false;

        $createSuccess = $this->createPhysicalFile($mimeType, $newImage, $newPath = $this->root_dir . "/" . $newPathName, 100);
        if (!$createSuccess)
            return false;

        return array("pathName" => $newPathName, "width" => $newWidth, "height" => $newHeight, "fileName" => $newFileName, "mimeType" => $mimeType, "size" => filesize($newPath));
    }

    public function resize($fileName, $pathName, $mimeType, $width, $height, $newWidth, $newHeight) {
        $image = $this->createImageFrom($pathName, $mimeType);
        $newPathName = str_replace($fileName, $newFileName = str_replace(strstr($fileName, ".", true), uniqid(), $fileName), $pathName);

        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        //Keep png file transparency
        if ($mimeType == "image/png") {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
            imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127));
        }

        $resizeSuccess = imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        if (!$resizeSuccess)
            return false;

        $createSuccess = $this->createPhysicalFile($mimeType, $newImage, $newPath = $this->root_dir . "/" . $newPathName, 100);
        if (!$createSuccess)
            return false;

        return array("pathName" => $newPathName
            , "width" => $newWidth
            , "height" => $newHeight
            , "fileName" => $newFileName
            , "mimeType" => $mimeType
            , "size" => filesize($newPath));
    }

    private function createImageFrom($pathName, $mimeType) {
        switch ($mimeType) {
            case "image/jpeg":
                return imagecreatefromjpeg($path = $this->root_dir . "/" . $pathName);
                break;
            case "image/png":
                return imagecreatefrompng($path = $this->root_dir . "/" . $pathName);
                break;
            default:
                throw new \Exception("You are trying to resize an unresizable file of MIME type " . $mimeType . ". Only png, jpeg files are accepted");
                break;
        }
    }

    private function createPhysicalFile($mimeType, $newImage, $newPath) {
        switch ($mimeType) {
            case "image/jpeg":
                return imagejpeg($newImage, $newPath, 100);
                break;
            case "image/png":
                return imagepng($newImage, $newPath);
                break;
            default:
                throw new \Exception("You are trying to resize an unresizable file of MIME type " . $mimeType . ". Only png, jpeg files are accepted");
                break;
        }
    }

}

?>
