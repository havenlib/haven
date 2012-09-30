<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PosBundle\Entity\OrderProductRepository")
 */
class OrderProduct
{

     /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Order", inversedBy="order_products")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    protected $order;

    /**
     * @ORM\ManyToOne(targetEntity="Evocatio\Bundle\PosBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * @ORM\Column(name="quantite", type="integer")
     */
    protected $quantite;

     /**
     * @var decimal $prix
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale = 2, nullable=false)
     */
    protected $prix;



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
     * Set quantite
     *
     * @param integer $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * Get quantite
     *
     * @return integer 
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set prix
     *
     * @param decimal $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * Get prix
     *
     * @return decimal 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Get prixFormate
     *
     * @return decimal
     */
    public function getPrixFormate()
    {
        return \money_format('%i', $this->prix);
    }

    /**
     * Get prixFormate
     *
     * @return decimal
     */
    public function getTotalFormate()
    {
        return \money_format('%i', $this->quantite*$this->prix);
    }
    /**
     * Get prixFormate
     *
     * @return decimal
     */
    public function getTotal()
    {
        return $this->quantite*$this->prix;
    }


    /**
     * Set order
     *
     * @param Evocatio\Bundle\PosBundle\Entity\Order $order
     */
    public function setOrder(\Evocatio\Bundle\PosBundle\Entity\Order $order)
    {
        $this->order = $order;
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

    /**
     * Set product
     *
     * @param Evocatio\Bundle\PosBundle\Entity\Product $produc
     */
    public function setProduct(\Evocatio\Bundle\PosBundle\Entity\Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get product
     *
     * @return Evocatio\Bundle\PosBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
}