<?php

namespace Evocatio\Bundle\PersonaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evocatio\Bundle\SecurityBundle\Entity\Company
 * @ORM\Entity()
 * 
 */
class Company extends Persona {

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=128, unique=false)
     */
    private $name;

    /**
     * @var integer $id
     */
    private $id;

    /**
     * Set name
     *
     * @param string $name
     * @return Company
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }
    
    public function getDiscriminator(){
        $discriminator_map = Company::getDiscriminatorMap();
        return array_search(get_class($this), $discriminator_map->value);
    }
}