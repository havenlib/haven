<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Evocatio\Bundle\CoreBundle\Generic\Translatable;

/**
 * Evocatio\Bundle\PosBundle\Entity\Products
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="plane", type="string")
 * @ORM\DiscriminatorMap({"generic"="GenericProduct"})
 */
class Product extends Translatable  implements \Serializable 
{

    /**
     * @var integer $id 
     * 
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var decimal $price
     * @ORM\Column(name="price" , type="decimal", scale=2)
     */
    private $price;

    /**
     * @var boolean $status
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;


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
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice($format = null, $locale = null)
    {
        if($format){
            if($locale){
                setlocale(LC_MONETARY, $locale);
            }
            return money_format("%".$format, $this->price);
        }
        return $this->price;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Product
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    public function serialize(){
        $data["id"] = $this->id;
        $data["status"] = $this->getStatus();
        $data["price"] = $this->getPrice();
        return serialize($data);
    }

    public function unserialize($data){
        $data = unserialize($data);
        $this->id = $data["id"];
        $this->setStatus($data["status"]);
        $this->setPrice($data["price"]);
    }
    
    public function getName() {
        throw new \Exception("Every product type should have a name and a description function ".get_called_class());
    }    
    
    public function getDescription() {
        throw new \Exception("Every product type should have a name and a description function ".get_called_class());
    }    
    
}