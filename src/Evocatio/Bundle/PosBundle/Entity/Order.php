<?php
namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Table(name="Order")
 * @ORM\Entity()
 */
class Order {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

//    /**
//     * @ORM\ManyToOne(targetEntity="Evocatio\Bundle\PersonaBundle\Entity\Contact")
//     */
//    protected $utilisateur;
    
    /**
     * @ORM\Column(name="date", type="date")
     */
    protected $date;

    /**
     * @ORM\Column(name="last_update", type="date")
     */
    protected $last_update;

    /**
     * @ORM\Column(name="status", type="integer")
     */
    protected $status;

    /**
     * @ORM\Column(name="memo", type="string", length=256, nullable=true)
     */
     protected $memo;

     /**
      * concatenate name and firstname for people, or just group name
      * @ORM\Column(name="delivery_name", type="string", length=256)
      */
     protected $delivery_name;

     /**
      * @ORM\Column(name="delivery_address1", type="string", length=256)
      */
     protected $delivery_address1;

     /**
      * @ORM\Column(name="delivery_address2", type="string", length=256, nullable = true)
      */
     protected $delivery_address2;

     /**
      * @ORM\Column(name="delivery_telephone", type="string", length=24, nullable = true )
      */
     protected $delivery_telephone;


     /**
      * @ORM\Column(name="delivery_city", type="string", length=64)
      */
     protected $delivery_city;

     /**
      * @ORM\Column(name="delivery_postal_code", type="string", length=16)
      */
     protected $delivery_postal_code;
     /**
      * @ORM\Column(name="delivery_state", type="string", length=24)
      */
     protected $delivery_state;
     /**
      * @ORM\Column(name="delivery_country", type="string", length=24)
      */
     protected $delivery_country;


     /**
      * concatenate name and firstname for people, or just group name
      * @ORM\Column(name="invoicing_name", type="string", length=256)
      */
     protected $invoicing_name;

     /**
      * @ORM\Column(name="invoicing_address1", type="string", length=256)
      */
     protected $invoicing_address1;

     /**
      * @ORM\Column(name="invoicing_address2", type="string", length=256, nullable = true)
      */
     protected $invoicing_address2;

     /**
      * @ORM\Column(name="invoicing_telephone", type="string", length=24, nullable = true)
      */
     protected $invoicing_telephone;


     /**
      * @ORM\Column(name="invoicing_city", type="string", length=64)
      */
     protected $invoicing_city;

     /**
      * @ORM\Column(name="invoicing_postal_code", type="string", length=16)
      */
     protected $invoicing_postal_code;

     /**
      * @ORM\Column(name="invoicing_state", type="string", length=24)
      */
     protected $invoicing_state;

     /**
      * @ORM\Column(name="invoicing_country", type="string", length=24)
      */
     protected $invoicing_country;
     /**
      * le total sans les tax ni le shipping
      * @ORM\Column(name="order_total_raw", type="decimal", scale=2)
      */
     protected $order_total_raw;

     /**
      * le montant total des tax
      * @ORM\Column(name="order_tax", type="decimal", scale=2)
      */
     protected $order_total_tax;
     /**
      * le total charger avec les tax et la delivery
      * @ORM\Column(name="order_total_charges", type="decimal", scale=2)
      */
     protected $order_total_charges;

     /**
      * @ORM\Column(name="delivery_charge", type="decimal", scale=2 )
      */
     protected $delivery_charge;

     /**
      * Le code international de 3 lettre pour la currency
      * @ORM\Column(name="currency", type="string", length=3)
      */
     protected $order_currency;

     /**
      * ici mettre une tables de tax pour la order lien a table tax pour savoir lesquelle s'appliques, il faut aussi des règles d'application
      * ce n'est pas ici le calcul des tax juste la liste de tax (ex: TPS, TVQ et leurs valeurs, donc ManyToManyWithExtraField , l'extra field à la valeur du moment pour la taxe
      * @ORM\OneToMany(targetEntity="OrderTax", mappedBy="order", cascade={"persist"})
      */
     protected $order_tax_applicables;

     /**
      *
      * @ORM\OneToMany(targetEntity="OrderProduct", mappedBy="order", cascade={"persist"})
      */
     protected $order_products;


     /**
      * @ORM\Column(name="confirmation", type="text", nullable=true)
      */
     protected $confirmation;

  
    public function __construct()
    {
        $this->order_tax_applicables = new \Doctrine\Common\Collections\ArrayCollection();
        $this->order_products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     * @return Order
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set last_update
     *
     * @param \DateTime $lastUpdate
     * @return Order
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->last_update = $lastUpdate;
    
        return $this;
    }

    /**
     * Get last_update
     *
     * @return \DateTime 
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Order
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set memo
     *
     * @param string $memo
     * @return Order
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
    
        return $this;
    }

    /**
     * Get memo
     *
     * @return string 
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * Set delivery_name
     *
     * @param string $deliveryName
     * @return Order
     */
    public function setDeliveryName($deliveryName)
    {
        $this->delivery_name = $deliveryName;
    
        return $this;
    }

    /**
     * Get delivery_name
     *
     * @return string 
     */
    public function getDeliveryName()
    {
        return $this->delivery_name;
    }

    /**
     * Set delivery_address1
     *
     * @param string $deliveryAddress1
     * @return Order
     */
    public function setDeliveryAddress1($deliveryAddress1)
    {
        $this->delivery_address1 = $deliveryAddress1;
    
        return $this;
    }

    /**
     * Get delivery_address1
     *
     * @return string 
     */
    public function getDeliveryAddress1()
    {
        return $this->delivery_address1;
    }

    /**
     * Set delivery_address2
     *
     * @param string $deliveryAddress2
     * @return Order
     */
    public function setDeliveryAddress2($deliveryAddress2)
    {
        $this->delivery_address2 = $deliveryAddress2;
    
        return $this;
    }

    /**
     * Get delivery_address2
     *
     * @return string 
     */
    public function getDeliveryAddress2()
    {
        return $this->delivery_address2;
    }

    /**
     * Set delivery_telephone
     *
     * @param string $deliveryTelephone
     * @return Order
     */
    public function setDeliveryTelephone($deliveryTelephone)
    {
        $this->delivery_telephone = $deliveryTelephone;
    
        return $this;
    }

    /**
     * Get delivery_telephone
     *
     * @return string 
     */
    public function getDeliveryTelephone()
    {
        return $this->delivery_telephone;
    }

    /**
     * Set delivery_city
     *
     * @param string $deliveryCity
     * @return Order
     */
    public function setDeliveryCity($deliveryCity)
    {
        $this->delivery_city = $deliveryCity;
    
        return $this;
    }

    /**
     * Get delivery_city
     *
     * @return string 
     */
    public function getDeliveryCity()
    {
        return $this->delivery_city;
    }

    /**
     * Set delivery_postal_code
     *
     * @param string $deliveryPostalCode
     * @return Order
     */
    public function setDeliveryPostalCode($deliveryPostalCode)
    {
        $this->delivery_postal_code = $deliveryPostalCode;
    
        return $this;
    }

    /**
     * Get delivery_postal_code
     *
     * @return string 
     */
    public function getDeliveryPostalCode()
    {
        return $this->delivery_postal_code;
    }

    /**
     * Set delivery_state
     *
     * @param string $deliveryState
     * @return Order
     */
    public function setDeliveryState($deliveryState)
    {
        $this->delivery_state = $deliveryState;
    
        return $this;
    }

    /**
     * Get delivery_state
     *
     * @return string 
     */
    public function getDeliveryState()
    {
        return $this->delivery_state;
    }

    /**
     * Set delivery_country
     *
     * @param string $deliveryCountry
     * @return Order
     */
    public function setDeliveryCountry($deliveryCountry)
    {
        $this->delivery_country = $deliveryCountry;
    
        return $this;
    }

    /**
     * Get delivery_country
     *
     * @return string 
     */
    public function getDeliveryCountry()
    {
        return $this->delivery_country;
    }

    /**
     * Set invoicing_name
     *
     * @param string $invoicingName
     * @return Order
     */
    public function setInvoicingName($invoicingName)
    {
        $this->invoicing_name = $invoicingName;
    
        return $this;
    }

    /**
     * Get invoicing_name
     *
     * @return string 
     */
    public function getInvoicingName()
    {
        return $this->invoicing_name;
    }

    /**
     * Set invoicing_address1
     *
     * @param string $invoicingAddress1
     * @return Order
     */
    public function setInvoicingAddress1($invoicingAddress1)
    {
        $this->invoicing_address1 = $invoicingAddress1;
    
        return $this;
    }

    /**
     * Get invoicing_address1
     *
     * @return string 
     */
    public function getInvoicingAddress1()
    {
        return $this->invoicing_address1;
    }

    /**
     * Set invoicing_address2
     *
     * @param string $invoicingAddress2
     * @return Order
     */
    public function setInvoicingAddress2($invoicingAddress2)
    {
        $this->invoicing_address2 = $invoicingAddress2;
    
        return $this;
    }

    /**
     * Get invoicing_address2
     *
     * @return string 
     */
    public function getInvoicingAddress2()
    {
        return $this->invoicing_address2;
    }

    /**
     * Set invoicing_telephone
     *
     * @param string $invoicingTelephone
     * @return Order
     */
    public function setInvoicingTelephone($invoicingTelephone)
    {
        $this->invoicing_telephone = $invoicingTelephone;
    
        return $this;
    }

    /**
     * Get invoicing_telephone
     *
     * @return string 
     */
    public function getInvoicingTelephone()
    {
        return $this->invoicing_telephone;
    }

    /**
     * Set invoicing_city
     *
     * @param string $invoicingCity
     * @return Order
     */
    public function setInvoicingCity($invoicingCity)
    {
        $this->invoicing_city = $invoicingCity;
    
        return $this;
    }

    /**
     * Get invoicing_city
     *
     * @return string 
     */
    public function getInvoicingCity()
    {
        return $this->invoicing_city;
    }

    /**
     * Set invoicing_postal_code
     *
     * @param string $invoicingPostalCode
     * @return Order
     */
    public function setInvoicingPostalCode($invoicingPostalCode)
    {
        $this->invoicing_postal_code = $invoicingPostalCode;
    
        return $this;
    }

    /**
     * Get invoicing_postal_code
     *
     * @return string 
     */
    public function getInvoicingPostalCode()
    {
        return $this->invoicing_postal_code;
    }

    /**
     * Set invoicing_state
     *
     * @param string $invoicingState
     * @return Order
     */
    public function setInvoicingState($invoicingState)
    {
        $this->invoicing_state = $invoicingState;
    
        return $this;
    }

    /**
     * Get invoicing_state
     *
     * @return string 
     */
    public function getInvoicingState()
    {
        return $this->invoicing_state;
    }

    /**
     * Set invoicing_country
     *
     * @param string $invoicingCountry
     * @return Order
     */
    public function setInvoicingCountry($invoicingCountry)
    {
        $this->invoicing_country = $invoicingCountry;
    
        return $this;
    }

    /**
     * Get invoicing_country
     *
     * @return string 
     */
    public function getInvoicingCountry()
    {
        return $this->invoicing_country;
    }

    /**
     * Set order_total_raw
     *
     * @param float $orderTotalRaw
     * @return Order
     */
    public function setOrderTotalRaw($orderTotalRaw)
    {
        $this->order_total_raw = $orderTotalRaw;
    
        return $this;
    }

    /**
     * Get order_total_raw
     *
     * @return float 
     */
    public function getOrderTotalRaw()
    {
        return $this->order_total_raw;
    }

    /**
     * Set order_total_tax
     *
     * @param float $orderTotalTax
     * @return Order
     */
    public function setOrderTotalTax($orderTotalTax)
    {
        $this->order_total_tax = $orderTotalTax;
    
        return $this;
    }

    /**
     * Get order_total_tax
     *
     * @return float 
     */
    public function getOrderTotalTax()
    {
        return $this->order_total_tax;
    }

    /**
     * Set order_total_charges
     *
     * @param float $orderTotalCharges
     * @return Order
     */
    public function setOrderTotalCharges($orderTotalCharges)
    {
        $this->order_total_charges = $orderTotalCharges;
    
        return $this;
    }

    /**
     * Get order_total_charges
     *
     * @return float 
     */
    public function getOrderTotalCharges()
    {
        return $this->order_total_charges;
    }

    /**
     * Set delivery_charge
     *
     * @param float $deliveryCharge
     * @return Order
     */
    public function setDeliveryCharge($deliveryCharge)
    {
        $this->delivery_charge = $deliveryCharge;
    
        return $this;
    }

    /**
     * Get delivery_charge
     *
     * @return float 
     */
    public function getDeliveryCharge()
    {
        return $this->delivery_charge;
    }

    /**
     * Set order_currency
     *
     * @param string $orderCurrency
     * @return Order
     */
    public function setOrderCurrency($orderCurrency)
    {
        $this->order_currency = $orderCurrency;
    
        return $this;
    }

    /**
     * Get order_currency
     *
     * @return string 
     */
    public function getOrderCurrency()
    {
        return $this->order_currency;
    }

    /**
     * Set confirmation
     *
     * @param string $confirmation
     * @return Order
     */
    public function setConfirmation($confirmation)
    {
        $this->confirmation = $confirmation;
    
        return $this;
    }

    /**
     * Get confirmation
     *
     * @return string 
     */
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * Add order_tax_applicables
     *
     * @param Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxApplicables
     * @return Order
     */
    public function addOrderTaxApplicable(\Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxApplicables)
    {
        $this->order_tax_applicables[] = $orderTaxApplicables;
    
        return $this;
    }

    /**
     * Remove order_tax_applicables
     *
     * @param Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxApplicables
     */
    public function removeOrderTaxApplicable(\Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxApplicables)
    {
        $this->order_tax_applicables->removeElement($orderTaxApplicables);
    }

    /**
     * Get order_tax_applicables
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrderTaxApplicables()
    {
        return $this->order_tax_applicables;
    }

    /**
     * Add order_products
     *
     * @param Evocatio\Bundle\PosBundle\Entity\OrderProduct $orderProducts
     * @return Order
     */
    public function addOrderProduct(\Evocatio\Bundle\PosBundle\Entity\OrderProduct $orderProducts)
    {
        $this->order_products[] = $orderProducts;
    
        return $this;
    }

    /**
     * Remove order_products
     *
     * @param Evocatio\Bundle\PosBundle\Entity\OrderProduct $orderProducts
     */
    public function removeOrderProduct(\Evocatio\Bundle\PosBundle\Entity\OrderProduct $orderProducts)
    {
        $this->order_products->removeElement($orderProducts);
    }

    /**
     * Get order_products
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrderProducts()
    {
        return $this->order_products;
    }
}