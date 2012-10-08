<?php

namespace Evocatio\Bundle\PersonaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Evocatio\Bundle\PersonaBundle\Entity\Address
 *
 * @ORM\Entity
 * @ORM\Table(name="Address")
 */
class Address extends Coordinate{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @Assert\NotBlank
     * @ORM\Column(name="address", type="string", length=255)
     */
    protected $address;
    
    /**
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     */
    protected $address2;
    
    /**
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    protected $country;
    /**
     * @var string $code_postal
     * @Assert\NotBlank
     * @ORM\Column(name="code_postal", type="string", length=12)
     */
    protected $code_postal;
    /**
     * @var string $ville
     * @Assert\NotBlank
     * @ORM\Column(name="ville", type="string", length=255)
     */
    protected $ville;
    
    /**
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    protected $state;

}