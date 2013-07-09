<?php

namespace Evocatio\Bundle\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CmsBundle\Entity\File;

/**
 * Evocatio\Bundle\CmsBundle\Entity\FileCredit
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class FileEmpty extends File {

    /**
     * @var integer $id
     *
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="files")
     * @ORM\JoinColumn(name="page_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * Set parent
     *
     * @param Evocatio\Bundle\CmsBundle\Entity\Page $parent
     * @return FileCredit
     */
    public function setParent(\Evocatio\Bundle\CmsBundle\Entity\Page $parent = null) {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Evocatio\Bundle\CmsBundle\Entity\Page
     */
    public function getParent() {
        return $this->parent;
    }

}