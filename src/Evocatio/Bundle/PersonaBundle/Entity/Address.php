<?php
//
//namespace Evocatio\Bundle\PersonaBundle\Entity;
//
//use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Constraints as Assert;
//use \Doctrine\Common\Collections\ArrayCollection;
//
///**
// * Evocatio\Bundle\PersonaBundle\Entity\Address
// *
// * @ORM\Entity
// * @ORM\Table(name="Address")
// */
//class Address extends Coordinate{
//
//    /**
//     * @ORM\Column(name="id", type="integer")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    protected $id;
//    
//    /**
//     * @Assert\NotBlank
//     * @ORM\Column(name="address", type="string", length=255)
//     */
//    protected $address;
//    
//    /**
//     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
//     */
//    protected $address2;
//    
//    /**
//     * @Assert\NotBlank
//     * @ORM\ManyToOne(targetEntity="Country")
//     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
//     */
//    protected $country;
//    /**
//     * @var string $code_postal
//     * @Assert\NotBlank
//     * @ORM\Column(name="code_postal", type="string", length=12)
//     */
//    protected $code_postal;
//    /**
//     * @var string $ville
//     * @Assert\NotBlank
//     * @ORM\Column(name="ville", type="string", length=255)
//     */
//    protected $ville;
//    
//    /**
//     * @Assert\NotBlank
//     * @ORM\ManyToOne(targetEntity="State")
//     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
//     */
//    protected $state;
//
//
//    /**
//     * Get id
//     *
//     * @return integer 
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * Set address
//     *
//     * @param string $address
//     * @return Address
//     */
//    public function setAddress($address)
//    {
//        $this->address = $address;
//    
//        return $this;
//    }
//
//    /**
//     * Get address
//     *
//     * @return string 
//     */
//    public function getAddress()
//    {
//        return $this->address;
//    }
//
//    /**
//     * Set address2
//     *
//     * @param string $address2
//     * @return Address
//     */
//    public function setAddress2($address2)
//    {
//        $this->address2 = $address2;
//    
//        return $this;
//    }
//
//    /**
//     * Get address2
//     *
//     * @return string 
//     */
//    public function getAddress2()
//    {
//        return $this->address2;
//    }
//
//    /**
//     * Set code_postal
//     *
//     * @param string $codePostal
//     * @return Address
//     */
//    public function setCodePostal($codePostal)
//    {
//        $this->code_postal = $codePostal;
//    
//        return $this;
//    }
//
//    /**
//     * Get code_postal
//     *
//     * @return string 
//     */
//    public function getCodePostal()
//    {
//        return $this->code_postal;
//    }
//
//    /**
//     * Set ville
//     *
//     * @param string $ville
//     * @return Address
//     */
//    public function setVille($ville)
//    {
//        $this->ville = $ville;
//    
//        return $this;
//    }
//
//    /**
//     * Get ville
//     *
//     * @return string 
//     */
//    public function getVille()
//    {
//        return $this->ville;
//    }
//
//    /**
//     * Set country
//     *
//     * @param Evocatio\Bundle\PersonaBundle\Entity\Country $country
//     * @return Address
//     */
//    public function setCountry(\Evocatio\Bundle\PersonaBundle\Entity\Country $country = null)
//    {
//        $this->country = $country;
//    
//        return $this;
//    }
//
//    /**
//     * Get country
//     *
//     * @return Evocatio\Bundle\PersonaBundle\Entity\Country 
//     */
//    public function getCountry()
//    {
//        return $this->country;
//    }
//
//    /**
//     * Set state
//     *
//     * @param Evocatio\Bundle\PersonaBundle\Entity\State $state
//     * @return Address
//     */
//    public function setState(\Evocatio\Bundle\PersonaBundle\Entity\State $state = null)
//    {
//        $this->state = $state;
//    
//        return $this;
//    }
//
//    /**
//     * Get state
//     *
//     * @return Evocatio\Bundle\PersonaBundle\Entity\State 
//     */
//    public function getState()
//    {
//        return $this->state;
//    }
//}