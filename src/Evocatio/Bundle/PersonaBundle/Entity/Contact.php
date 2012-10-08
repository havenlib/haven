<?php

namespace Evocatio\Bundle\PersonaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

use Evocatio\Bundle\PersonaBundle\Entity\ContactAddress;

/**
 * Evocatio\Bundle\PersonaBundle\Entity\Contact
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PersonaBundle\Entity\ContactRepository")
 */
class Contact {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="ContactAddress", mappedBy="contact", cascade={"persist"})
     */
    protected $contact_address;

        /**
     * @ORM\ManyToMany(targetEntity="Coordinate", mappedBy="contact", cascade={"persist"})
     */
    protected $coordinate;
    
    /**
     * @ORM\Column(name="telephone", type="string", length=255, nullable=true)
     */
    protected $telephone;

    /**
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     */
    protected $lastname;

    /**
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * Get title
     *
     * @return string
     */
    public function getCiviliteFormate() {
        $tmp = array('1' => 'Mme', '2' => 'M');
        return ($this->getCivilite()) ? $tmp[$this->getCivilite()] : null;
    }

    /**
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\Address
     */
    public function getAddressFacturation() {
//        return ('blue');
        $address = $this->getContactAddress()->filter(function($contactAddress) {
                    return ($contactAddress->getType() == "Facturation");
                })

        ;
        if ($address->count() != 0) {

            return $address->current()->getAddress();
        }
    }

    /**
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\Address
     */
    public function getAddressLivraison() {
        $address = $this->getContactAddress()->filter(function($contactAddress) {
                    return ($contactAddress->getType() == "Livraison");
                })

        ;
        if ($address->count() != 0) {

            return $address->current()->getAddress();
        }
    }

    /**
     * Set les deux addresss (Livraison et Facturation) à la même address (au gré du post)
     * @param string $laquelle  soit Livraison ou Facturation
     */
    public function utiliseUneSeuleAddress($laquelle) {
        if ($this->getContactAddress()->count() < 2)
            $this->makeSureWeHaveBothAddresss();
        $contact_addresss = $this->getContactAddress();
        $laBonne = $this->{"getAddress" . $laquelle}();
        if (empty($laBonne))
            $laBonne = new \Evocatio\Bundle\PersonaBundle\Entity\Address();
//        echo $laquelle;die();
        foreach ($contact_addresss as $contact_address) {
//            echo '<br>type : '.$address->getType();
            $contact_address->setAddress($laBonne);
        }
    }

    public function utiliseDeuxAddresss() {
        if ($this->getContactAddress()->count() < 2)
            $this->makeSureWeHaveBothAddresss();
//        vérifie que les deux addresss sont un lien à la même address (et pas null)
        if ($this->estCeLaMemeAddress()) {
//                 si oui on doit créer une nouvelle address pour l'un des deux cas
            $this->getContactAddress()->first()->setAddress(new Address());
        }
    }

    /**
     *  Verifie si les deux liens vont vers la même address (et ne sont pas null)
     * @return Boolean
     */
    public function estCeLaMemeAddress() {
        $contact_addresss = $this->getContactAddress();
        return ($contact_addresss->filter(function($contact_address) {
                                    return ($contact_address->getType() == "Livraison");
                                })
                        ->first()->getAddress() ==
                        $contact_addresss->filter(function($contact_address) {
                                    return ($contact_address->getType() == "Facturation");
                                })
                        ->first()->getAddress() &&
                        $contact_addresss->filter(function($contact_address) {
                                    return ($contact_address->getType() == "Facturation");
                                })
                        ->first()->getAddress() instanceof Address );
    }

    public function makeSureWeHaveBothAddresss() {
        if (!$this->getAddressFacturation()) {
            $au = new \Evocatio\Bundle\PersonaBundle\Entity\ContactAddress();
            $au->setType('Facturation');
            $au->setContact($this);
            $this->getContactAddress()->add($au);
//            $user->setAddressFacturation(new \Evocatio\Bundle\PersonaBundle\Entity\Address);
        }
        if (!$this->getAddressLivraison()) {
            $au = new \Evocatio\Bundle\PersonaBundle\Entity\ContactAddress();
            $au->setType('Livraison');
            $au->setContact($this);
            $this->getContactAddress()->add($au);
//            $user->setAddressFacturation(new \Evocatio\Bundle\PersonaBundle\Entity\Address);
        }
    }
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
     * Set telephone
     *
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setCivilite($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getCivilite()
    {
        return $this->title;
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
     * Add coordinate
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Coordinate $coordinate
     */
    public function addCoordinate(\Evocatio\Bundle\PersonaBundle\Entity\Coordinate $coordinate)
    {
        $this->coordinate[] = $coordinate;
    }

    /**
     * Get coordinate
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCoordinate()
    {
        return $this->coordinate;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Contact
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add contact_address
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\ContactAddress $contactAddress
     * @return Contact
     */
    public function addContactAddres(\Evocatio\Bundle\PersonaBundle\Entity\ContactAddress $contactAddress)
    {
        $this->contact_address[] = $contactAddress;
    
        return $this;
    }

    /**
     * Remove contact_address
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\ContactAddress $contactAddress
     */
    public function removeContactAddres(\Evocatio\Bundle\PersonaBundle\Entity\ContactAddress $contactAddress)
    {
        $this->contact_address->removeElement($contactAddress);
    }

    /**
     * Remove coordinate
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Coordinate $coordinate
     */
    public function removeCoordinate(\Evocatio\Bundle\PersonaBundle\Entity\Coordinate $coordinate)
    {
        $this->coordinate->removeElement($coordinate);
    }
}