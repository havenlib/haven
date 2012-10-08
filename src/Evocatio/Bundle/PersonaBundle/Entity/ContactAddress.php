<?php
//
//namespace Evocatio\Bundle\PersonaBundle\Entity;
//
//use Doctrine\ORM\Mapping as ORM;
//use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
//
///**
// * @ORM\Entity
// * @ORM\Table(name="ContactAddress", uniqueConstraints={@ORM\UniqueConstraint(name="contact_address_idx", columns={"utilisateur_id", "type"})})
// */
//class ContactAddress {
//
//    /**
//     * @ORM\Column(name="id", type="integer")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    protected $id;
//    /**
//     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="contact_address")
//     * @ORM\JoinColumn(name="utilisateur_id", referencedColumnName="id")
//     */
//    protected $contact;
//    
//    /**
//     * @ORM\ManyToOne(targetEntity="Address", inversedBy="contact_address", cascade={"persist"})
//     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
//     */
//    protected $address;
//    
//    /**
//     * @ORM\Column(name="type", type="string", length=32)
//     */
//    protected $type;
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
//     * Set type
//     *
//     * @param string $type
//     */
//    public function setType($type)
//    {
//        $this->type = $type;
//    }
//
//    /**
//     * Get type
//     *
//     * @return string 
//     */
//    public function getType()
//    {
//        return $this->type;
//    }
//
//    /**
//     * Set contact
//     *
//     * @param Evocatio\Bundle\PersonaBundle\Entity\Contact $contact
//     */
//    public function setContact(\Evocatio\Bundle\PersonaBundle\Entity\Contact $contact)
//    {
//        $this->contact = $contact;
//    }
//
//    /**
//     * Get contact
//     *
//     * @return Evocatio\Bundle\PersonaBundle\Entity\Contact 
//     */
//    public function getContact()
//    {
//        return $this->contact;
//    }
//
//    /**
//     * Set address
//     *
//     * @param Evocatio\Bundle\PersonaBundle\Entity\Address $address
//     */
//    public function setAddress(\Evocatio\Bundle\PersonaBundle\Entity\Address $address)
//    {
//        $this->address = $address;
//    }
//
//    /**
//     * Get address
//     *
//     * @return Evocatio\Bundle\PersonaBundle\Entity\Address 
//     */
//    public function getAddress()
//    {
//        return $this->address;
//    }
//}