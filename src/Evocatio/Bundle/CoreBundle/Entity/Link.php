<?php

namespace Evocatio\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evocatio\Bundle\CoreBundle\Entity\Link
 * @ORM\Entity()
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="discr", type="string")
 * @DiscriminatorMap({
 * "internal" = "Evocatio\Bundle\CoreBundle\Entity\InternalLink"
 * ,"external" = "Evocatio\Bundle\CoreBundle\Entity\ExternalLink"
 * }) 
 */
class Link {
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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