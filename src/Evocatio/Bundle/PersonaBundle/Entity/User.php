<?php

namespace Evocatio\Bundle\PersonaBundle\Entity;

use Evocatio\Bundle\SecurityBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
 * Evocatio\Bundle\SecurityBundle\Entity\User
 *
 * @ORM\Table(name="User")
 * */
class User extends BaseUser {

    /**
     * @ORM\OneToOne(targetEntity="Persona", cascade="all")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $persona;

}

?>
