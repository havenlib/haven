<?php

/*
 * This file is part of the Evocatio package.
 *
 * (c) Laurent Breleur <lbreleur@evocatio.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evocatio\Bundle\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\MediaBundle\Entity\File;

/**
 * @ORM\Entity()
 */
class ImageFile extends File {

    /**
     * @var integer $width
     * @ORM\Column(name="width", type="integer")
     */
    private $width;

    /**
     * @var integer $height
     * @ORM\Column(name="height", type="integer")
     */
    private $height;


    /**
     * Set width
     *
     * @param integer $width
     * @return ImageFile
     */
    public function setWidth($width)
    {
        $this->width = $width;
    
        return $this;
    }

    /**
     * Get width
     *
     * @return integer 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param integer $height
     * @return ImageFile
     */
    public function setHeight($height)
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * Get height
     *
     * @return integer 
     */
    public function getHeight()
    {
        return $this->height;
    }
}