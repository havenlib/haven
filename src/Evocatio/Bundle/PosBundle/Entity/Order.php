<?php
namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @ORM\Table(name="Orders")
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PosBundle\Entity\OrderRepository")
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
      * @ORM\Column(name="delivery_name", type="string", length=128)
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
      * @ORM\Column(name="delivery_ville", type="string", length=64)
      */
     protected $delivery_ville;

     /**
      * @ORM\Column(name="delivery_code_postale", type="string", length=16)
      */
     protected $delivery_code_postale;
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
      * @ORM\Column(name="invoicing_name", type="string", length=128)
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
      * @ORM\Column(name="invoicing_ville", type="string", length=64)
      */
     protected $invoicing_ville;

     /**
      * @ORM\Column(name="invoicing_code_postale", type="string", length=16)
      */
     protected $invoicing_code_postale;

     /**
      * @ORM\Column(name="invoicing_state", type="string", length=24)
      */
     protected $invoicing_state;

     /**
      * @ORM\Column(name="invoicing_country", type="string", length=24)
      */
     protected $invoicing_country;
     /**
      * le total sans les taxes ni le shipping
      * @ORM\Column(name="order_total", type="decimal", scale=2)
      */
     protected $order_total;

     /**
      * le montant total des taxes
      * @ORM\Column(name="order_taxes", type="decimal", scale=2)
      */
     protected $order_total_taxes;
     /**
      * le total charger avec les taxes et la delivery
      * @ORM\Column(name="order_charge_total", type="decimal", scale=2)
      */
     protected $order_charge_total;

     /**
      * @ORM\Column(name="delivery_cost", type="decimal", scale=2 )
      */
     protected $delivery_cost;

     /**
      * Le code international de 3 lettre pour la devise
      * @ORM\Column(name="devise", type="string", length=3)
      */
     protected $order_devise;

     /**
      * ici mettre une tables de taxes pour la order lien a table taxes pour savoir lesquelle s'appliques, il faut aussi des règles d'application
      * ce n'est pas ici le calcul des taxes juste la liste de taxes (ex: TPS, TVQ et leurs valeurs, donc ManyToManyWithExtraField , l'extra field à la valeur du moment pour la taxe
      * @ORM\OneToMany(targetEntity="OrderTax", mappedBy="order", cascade={"persist"})
      */
     protected $order_taxes_applicables;

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
        $this->order_taxes_applicables = new \Doctrine\Common\Collections\ArrayCollection();
        $this->order_products = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}