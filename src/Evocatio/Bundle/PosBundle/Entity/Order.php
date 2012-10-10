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
      * @ORM\Column(name="livraison_prenom", type="string", length=64)
      */
     protected $livraison_prenom;

     /**
      * @ORM\Column(name="livraison_nom", type="string", length=128)
      */
     protected $livraison_nom;

     /**
      * @ORM\Column(name="livraison_address1", type="string", length=256)
      */
     protected $livraison_address1;

     /**
      * @ORM\Column(name="livraison_address2", type="string", length=256, nullable = true)
      */
     protected $livraison_address2;

     /**
      * @ORM\Column(name="livraison_telephone", type="string", length=24, nullable = true )
      */
     protected $livraison_telephone;


     /**
      * @ORM\Column(name="livraison_ville", type="string", length=64)
      */
     protected $livraison_ville;

     /**
      * @ORM\Column(name="livraison_code_postale", type="string", length=16)
      */
     protected $livraison_code_postale;
     /**
      * @ORM\Column(name="livraison_state", type="string", length=24)
      */
     protected $livraison_state;
     /**
      * @ORM\Column(name="livraison_country", type="string", length=24)
      */
     protected $livraison_country;

     /**
      * @ORM\Column(name="facturation_prenom", type="string", length=64)
      */
     protected $facturation_prenom;

     /**
      * @ORM\Column(name="facturation_nom", type="string", length=128)
      */
     protected $facturation_nom;

     /**
      * @ORM\Column(name="facturation_address1", type="string", length=256)
      */
     protected $facturation_address1;

     /**
      * @ORM\Column(name="facturation_address2", type="string", length=256, nullable = true)
      */
     protected $facturation_address2;

     /**
      * @ORM\Column(name="facturation_telephone", type="string", length=24, nullable = true)
      */
     protected $facturation_telephone;


     /**
      * @ORM\Column(name="facturation_ville", type="string", length=64)
      */
     protected $facturation_ville;

     /**
      * @ORM\Column(name="facturation_code_postale", type="string", length=16)
      */
     protected $facturation_code_postale;

     /**
      * @ORM\Column(name="facturation_state", type="string", length=24)
      */
     protected $facturation_state;

     /**
      * @ORM\Column(name="facturation_country", type="string", length=24)
      */
     protected $facturation_country;
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
      * le total charger avec les taxes et la livraison
      * @ORM\Column(name="order_charge_total", type="decimal", scale=2)
      */
     protected $order_charge_total;

     /**
      * @ORM\Column(name="livraison_cout", type="decimal", scale=2 )
      */
     protected $livraison_cout;

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
      * @ORM\Column(name="recommendation", type="string", length=255, nullable=true)
      */
     protected $recommendation;

     /**
      * @ORM\Column(name="confirmation", type="text", nullable=true)
      */
     protected $confirmation;

  
    /**
     * Get order_total
     *
     * @return decimal
     */
    public function getOrderTotalFormate()
    {
        return \money_format('%i', $this->order_total);
    }

    /**
     * Get order_total_taxes
     *
     * @return decimal
     */
    public function getOrderTotalTaxsFormate()
    {
        return \money_format('%i', $this->order_total_taxes);
    }


    /**
     * Get order_charge_total
     *
     * @return decimal
     */
    public function getOrderChargeTotalFormate()
    {
        return \money_format('%i', $this->order_charge_total);
    }
    /**
     * Get livraison_cout
     *
     * @return decimal
     */
    public function getLivraisonCoutFormate()
    {
        return \money_format('%i', $this->livraison_cout);
    }
    public function __construct()
    {
        $this->order_taxes_applicables = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set last_update
     *
     * @param date $lastUpdate
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->last_update = $lastUpdate;
    }

    /**
     * Get last_update
     *
     * @return date 
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;
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
     * Set livraison_prenom
     *
     * @param string $livraisonPrenom
     */
    public function setLivraisonPrenom($livraisonPrenom)
    {
        $this->livraison_prenom = $livraisonPrenom;
    }

    /**
     * Get livraison_prenom
     *
     * @return string 
     */
    public function getLivraisonPrenom()
    {
        return $this->livraison_prenom;
    }

    /**
     * Set livraison_nom
     *
     * @param string $livraisonNom
     */
    public function setLivraisonNom($livraisonNom)
    {
        $this->livraison_nom = $livraisonNom;
    }

    /**
     * Get livraison_nom
     *
     * @return string 
     */
    public function getLivraisonNom()
    {
        return $this->livraison_nom;
    }

    /**
     * Set livraison_address1
     *
     * @param string $livraisonAddress1
     */
    public function setLivraisonAddress1($livraisonAddress1)
    {
        $this->livraison_address1 = $livraisonAddress1;
    }

    /**
     * Get livraison_address1
     *
     * @return string 
     */
    public function getLivraisonAddress1()
    {
        return $this->livraison_address1;
    }

    /**
     * Set livraison_address2
     *
     * @param string $livraisonAddress2
     */
    public function setLivraisonAddress2($livraisonAddress2)
    {
        $this->livraison_address2 = $livraisonAddress2;
    }

    /**
     * Get livraison_address2
     *
     * @return string 
     */
    public function getLivraisonAddress2()
    {
        return $this->livraison_address2;
    }

    /**
     * Set livraison_telephone
     *
     * @param string $livraisonTelephone
     */
    public function setLivraisonTelephone($livraisonTelephone)
    {
        $this->livraison_telephone = $livraisonTelephone;
    }

    /**
     * Get livraison_telephone
     *
     * @return string 
     */
    public function getLivraisonTelephone()
    {
        return $this->livraison_telephone;
    }

    /**
     * Set livraison_ville
     *
     * @param string $livraisonVille
     */
    public function setLivraisonVille($livraisonVille)
    {
        $this->livraison_ville = $livraisonVille;
    }

    /**
     * Get livraison_ville
     *
     * @return string 
     */
    public function getLivraisonVille()
    {
        return $this->livraison_ville;
    }

    /**
     * Set livraison_code_postale
     *
     * @param string $livraisonCodePostale
     */
    public function setLivraisonCodePostale($livraisonCodePostale)
    {
        $this->livraison_code_postale = $livraisonCodePostale;
    }

    /**
     * Get livraison_code_postale
     *
     * @return string 
     */
    public function getLivraisonCodePostale()
    {
        return $this->livraison_code_postale;
    }

    /**
     * Set livraison_state
     *
     * @param string $livraisonState
     */
    public function setLivraisonState($livraisonState)
    {
        $this->livraison_state = $livraisonState;
    }

    /**
     * Get livraison_state
     *
     * @return string 
     */
    public function getLivraisonState()
    {
        return $this->livraison_state;
    }

    /**
     * Set livraison_country
     *
     * @param string $livraisonCountry
     */
    public function setLivraisonCountry($livraisonCountry)
    {
        $this->livraison_country = $livraisonCountry;
    }

    /**
     * Get livraison_country
     *
     * @return string 
     */
    public function getLivraisonCountry()
    {
        return $this->livraison_country;
    }

    /**
     * Set facturation_prenom
     *
     * @param string $facturationPrenom
     */
    public function setFacturationPrenom($facturationPrenom)
    {
        $this->facturation_prenom = $facturationPrenom;
    }

    /**
     * Get facturation_prenom
     *
     * @return string 
     */
    public function getFacturationPrenom()
    {
        return $this->facturation_prenom;
    }

    /**
     * Set facturation_nom
     *
     * @param string $facturationNom
     */
    public function setFacturationNom($facturationNom)
    {
        $this->facturation_nom = $facturationNom;
    }

    /**
     * Get facturation_nom
     *
     * @return string 
     */
    public function getFacturationNom()
    {
        return $this->facturation_nom;
    }

    /**
     * Set facturation_address1
     *
     * @param string $facturationAddress1
     */
    public function setFacturationAddress1($facturationAddress1)
    {
        $this->facturation_address1 = $facturationAddress1;
    }

    /**
     * Get facturation_address1
     *
     * @return string 
     */
    public function getFacturationAddress1()
    {
        return $this->facturation_address1;
    }

    /**
     * Set facturation_address2
     *
     * @param string $facturationAddress2
     */
    public function setFacturationAddress2($facturationAddress2)
    {
        $this->facturation_address2 = $facturationAddress2;
    }

    /**
     * Get facturation_address2
     *
     * @return string 
     */
    public function getFacturationAddress2()
    {
        return $this->facturation_address2;
    }

    /**
     * Set facturation_telephone
     *
     * @param string $facturationTelephone
     */
    public function setFacturationTelephone($facturationTelephone)
    {
        $this->facturation_telephone = $facturationTelephone;
    }

    /**
     * Get facturation_telephone
     *
     * @return string 
     */
    public function getFacturationTelephone()
    {
        return $this->facturation_telephone;
    }

    /**
     * Set facturation_ville
     *
     * @param string $facturationVille
     */
    public function setFacturationVille($facturationVille)
    {
        $this->facturation_ville = $facturationVille;
    }

    /**
     * Get facturation_ville
     *
     * @return string 
     */
    public function getFacturationVille()
    {
        return $this->facturation_ville;
    }

    /**
     * Set facturation_code_postale
     *
     * @param string $facturationCodePostale
     */
    public function setFacturationCodePostale($facturationCodePostale)
    {
        $this->facturation_code_postale = $facturationCodePostale;
    }

    /**
     * Get facturation_code_postale
     *
     * @return string 
     */
    public function getFacturationCodePostale()
    {
        return $this->facturation_code_postale;
    }

    /**
     * Set facturation_state
     *
     * @param string $facturationState
     */
    public function setFacturationState($facturationState)
    {
        $this->facturation_state = $facturationState;
    }

    /**
     * Get facturation_state
     *
     * @return string 
     */
    public function getFacturationState()
    {
        return $this->facturation_state;
    }

    /**
     * Set facturation_country
     *
     * @param string $facturationCountry
     */
    public function setFacturationCountry($facturationCountry)
    {
        $this->facturation_country = $facturationCountry;
    }

    /**
     * Get facturation_country
     *
     * @return string 
     */
    public function getFacturationCountry()
    {
        return $this->facturation_country;
    }

    /**
     * Set order_total
     *
     * @param decimal $orderTotal
     */
    public function setOrderTotal($orderTotal)
    {
        $this->order_total = $orderTotal;
    }

    /**
     * Get order_total
     *
     * @return decimal 
     */
    public function getOrderTotal()
    {
        return $this->order_total;
    }

    /**
     * Set order_total_taxes
     *
     * @param decimal $orderTotalTaxs
     */
    public function setOrderTotalTaxs($orderTotalTaxs)
    {
        $this->order_total_taxes = $orderTotalTaxs;
    }

    /**
     * Get order_total_taxes
     *
     * @return decimal 
     */
    public function getOrderTotalTaxs()
    {
        return $this->order_total_taxes;
    }

    /**
     * Set order_charge_total
     *
     * @param decimal $orderChargeTotal
     */
    public function setOrderChargeTotal($orderChargeTotal)
    {
        $this->order_charge_total = $orderChargeTotal;
    }

    /**
     * Get order_charge_total
     *
     * @return decimal 
     */
    public function getOrderChargeTotal()
    {
        return $this->order_charge_total;
    }

    /**
     * Set livraison_cout
     *
     * @param decimal $livraisonCout
     */
    public function setLivraisonCout($livraisonCout)
    {
        $this->livraison_cout = $livraisonCout;
    }

    /**
     * Get livraison_cout
     *
     * @return decimal 
     */
    public function getLivraisonCout()
    {
        return $this->livraison_cout;
    }

    /**
     * Set order_devise
     *
     * @param string $orderDevise
     */
    public function setOrderDevise($orderDevise)
    {
        $this->order_devise = $orderDevise;
    }

    /**
     * Get order_devise
     *
     * @return string 
     */
    public function getOrderDevise()
    {
        return $this->order_devise;
    }

    /**
     * Set recommendation
     *
     * @param string $recommendation
     */
    public function setRecommendation($recommendation)
    {
        $this->recommendation = $recommendation;
    }

    /**
     * Get recommendation
     *
     * @return string 
     */
    public function getRecommendation()
    {
        return $this->recommendation;
    }

    /**
     * Set confirmation
     *
     * @param text $confirmation
     */
    public function setConfirmation($confirmation)
    {
        $this->confirmation = $confirmation;
    }

    /**
     * Get confirmation
     *
     * @return text 
     */
    public function getConfirmation()
    {
        return $this->confirmation;
    }

    /**
     * Set utilisateur
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Contact $utilisateur
     */
    public function setUtilisateur(\Evocatio\Bundle\PersonaBundle\Entity\Contact $utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }

    /**
     * Get utilisateur
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\Contact
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Add order_taxes_applicables
     *
     * @param Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxsApplicables
     */
    public function addOrderTax(\Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxsApplicables)
    {
        $this->order_taxes_applicables[] = $orderTaxsApplicables;
    }

    /**
     * Get order_taxes_applicables
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrderTaxsApplicables()
    {
        return $this->order_taxes_applicables;
    }

    /**
     * Add order_products
     *
     * @param Evocatio\Bundle\PosBundle\Entity\OrderProduct $orderProducts
     */
    public function addOrderProduct(\Evocatio\Bundle\PosBundle\Entity\OrderProduct $orderProducts)
    {
        $this->order_products[] = $orderProducts;
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

    /**
     * Set livraison_address1
     *
     * @param string $livraisonAdresse1
     */
    public function setLivraisonAdresse1($livraisonAdresse1)
    {
        $this->livraison_address1 = $livraisonAdresse1;
    }

    /**
     * Get livraison_address1
     *
     * @return string 
     */
    public function getLivraisonAdresse1()
    {
        return $this->livraison_address1;
    }

    /**
     * Set livraison_address2
     *
     * @param string $livraisonAdresse2
     */
    public function setLivraisonAdresse2($livraisonAdresse2)
    {
        $this->livraison_address2 = $livraisonAdresse2;
    }

    /**
     * Get livraison_address2
     *
     * @return string 
     */
    public function getLivraisonAdresse2()
    {
        return $this->livraison_address2;
    }

    /**
     * Set facturation_address1
     *
     * @param string $facturationAdresse1
     */
    public function setFacturationAdresse1($facturationAdresse1)
    {
        $this->facturation_address1 = $facturationAdresse1;
    }

    /**
     * Get facturation_address1
     *
     * @return string 
     */
    public function getFacturationAdresse1()
    {
        return $this->facturation_address1;
    }

    /**
     * Set facturation_address2
     *
     * @param string $facturationAdresse2
     */
    public function setFacturationAdresse2($facturationAdresse2)
    {
        $this->facturation_address2 = $facturationAdresse2;
    }

    /**
     * Get facturation_address2
     *
     * @return string 
     */
    public function getFacturationAdresse2()
    {
        return $this->facturation_address2;
    }

    /**
     * Set order_total_taxes
     *
     * @param decimal $orderTotalTaxes
     */
    public function setOrderTotalTaxes($orderTotalTaxes)
    {
        $this->order_total_taxes = $orderTotalTaxes;
    }

    /**
     * Get order_total_taxes
     *
     * @return decimal 
     */
    public function getOrderTotalTaxes()
    {
        return $this->order_total_taxes;
    }

    /**
     * Get order_taxes_applicables
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOrderTaxesApplicables()
    {
        return $this->order_taxes_applicables;
    }

    /**
     * Add order_taxes_applicables
     *
     * @param Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxesApplicables
     * @return Order
     */
    public function addOrderTaxesApplicable(\Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxesApplicables)
    {
        $this->order_taxes_applicables[] = $orderTaxesApplicables;
    
        return $this;
    }

    /**
     * Remove order_taxes_applicables
     *
     * @param Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxesApplicables
     */
    public function removeOrderTaxesApplicable(\Evocatio\Bundle\PosBundle\Entity\OrderTax $orderTaxesApplicables)
    {
        $this->order_taxes_applicables->removeElement($orderTaxesApplicables);
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
}