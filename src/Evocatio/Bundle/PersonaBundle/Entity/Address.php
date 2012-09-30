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
class Address {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\OneToMany(targetEntity="ContactAddress", mappedBy="address")
     */
    protected $contact_address;
    
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


    public function __construct()
    {
        $this->contact_address = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address2
     *
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set code_postal
     *
     * @param string $codePostal
     */
    public function setCodePostal($codePostal)
    {
        $this->code_postal = $codePostal;
    }

    /**
     * Get code_postal
     *
     * @return string 
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Add contact_address
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\ContactAddress $contactAddress
     */
    public function addContactAddress(\Evocatio\Bundle\PersonaBundle\Entity\ContactAddress $contactAddress)
    {
        $this->contact_address[] = $contactAddress;
    }

    /**
     * Get contact_address
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getContactAddress()
    {
        return $this->contact_address;
    }

    /**
     * Set country
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Country $country
     */
    public function setCountry(\Evocatio\Bundle\PersonaBundle\Entity\Country $country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\State $state
     */
    public function setState(\Evocatio\Bundle\PersonaBundle\Entity\State $state)
    {
        $this->state = $state;
    }

    /**
     * Get state
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }
}