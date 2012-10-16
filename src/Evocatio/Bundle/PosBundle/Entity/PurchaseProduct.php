<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity()
 */
class PurchaseProduct  implements \Serializable {
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Purchase", inversedBy="purchase_products")
     * @ORM\JoinColumn(name="purchase_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $purchase;

    /**
     * @ORM\ManyToOne(targetEntity="Evocatio\Bundle\PosBundle\Entity\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    /**
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity;

    /**
     * @var decimal $price
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale = 2, nullable=false)
     */
    protected $price;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return PurchaseProduct
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return PurchaseProduct
     */
    public function setPrice($price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set purchase
     *
     * @param Evocatio\Bundle\PosBundle\Entity\Purchase $purchase
     * @return PurchaseProduct
     */
    public function setPurchase(\Evocatio\Bundle\PosBundle\Entity\Purchase $purchase = null) {
        $this->purchase = $purchase;

        return $this;
    }

    /**
     * Get purchase
     *
     * @return Evocatio\Bundle\PosBundle\Entity\Purchase 
     */
    public function getPurchase() {
        return $this->purchase;
    }

    /**
     * Set product
     *
     * @param Evocatio\Bundle\PosBundle\Entity\Product $product
     * @return PurchaseProduct
     */
    public function setProduct(\Evocatio\Bundle\PosBundle\Entity\Product $product = null) {
        $this->product = $product;
        $this->price = $this->getProduct()->getPrice();

        return $this;
    }

    /**
     * Get product
     *
     * @return Evocatio\Bundle\PosBundle\Entity\Product 
     */
    public function getProduct() {
        return $this->product;
    }

    public function serialize() {
        $data["id"] = $this->id;        
        $data["product"]= serialize($this->getProduct());
        $data["quantity"] = $this->getQuantity();
        $data["price"] = $this->getPrice();
        return serialize($data);
    }

    public function unserialize($data) {
        $data = unserialize($data);
        $this->id = $data["id"];        
        $this->setProduct(unserialize($data["product"]));
        $this->setQuantity($data["quantity"]);
        $this->setPrice($data["price"]);
    }

}