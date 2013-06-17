<?php

namespace Evocatio\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evocatio\Bundle\WebBundle\Entity\PostCategory
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PostCategory extends \Evocatio\Bundle\CoreBundle\Entity\Category {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}