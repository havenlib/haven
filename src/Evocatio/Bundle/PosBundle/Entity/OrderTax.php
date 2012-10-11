<?php
namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class OrderTax {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="order_taxes_applicables")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;
    
    /**
     * @ORM\Column(name="name", type="string", length=8)
     */
    protected $name;

     /**
      *
      * @ORM\Column(name="rate", type="float")
      */
     protected $rate;
     /**
      *
      * @ORM\Column(name="applied_on", type="decimal", scale=2)
      */
     protected $applied_on;
     /**
      *
      * @ORM\Column(name="applied_amount", type="decimal", scale=2)
      */
     protected $applied_amount;

    /**
     * le rank servira lorsque le rate est composé, il sert à dire à quel rank la taxe sera calcule, ex Québec TPS rank 0 (calculé seule) puis TVQ rank 1 (calculé avec le total de base + ranks précédent)
     * @ORM\Column(name="rank", type="integer", nullable=true)
     */
    protected $rank;


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
     * Set name
     *
     * @param string $name
     * @return OrderTax
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set rate
     *
     * @param float $rate
     * @return OrderTax
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set applied_on
     *
     * @param float $appliedOn
     * @return OrderTax
     */
    public function setAppliedOn($appliedOn)
    {
        $this->applied_on = $appliedOn;
    
        return $this;
    }

    /**
     * Get applied_on
     *
     * @return float 
     */
    public function getAppliedOn()
    {
        return $this->applied_on;
    }

    /**
     * Set applied_amount
     *
     * @param float $appliedAmount
     * @return OrderTax
     */
    public function setAppliedAmount($appliedAmount)
    {
        $this->applied_amount = $appliedAmount;
    
        return $this;
    }

    /**
     * Get applied_amount
     *
     * @return float 
     */
    public function getAppliedAmount()
    {
        return $this->applied_amount;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return OrderTax
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
    
        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set order
     *
     * @param Evocatio\Bundle\PosBundle\Entity\Order $order
     * @return OrderTax
     */
    public function setOrder(\Evocatio\Bundle\PosBundle\Entity\Order $order = null)
    {
        $this->order = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return Evocatio\Bundle\PosBundle\Entity\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }
}