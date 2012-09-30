<?php
namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PosBundle\Entity\OrderTaxRepository")
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
     * @ORM\Column(name="nom", type="string", length=8)
     */
    protected $nom;

     /**
      *
      * @ORM\Column(name="taux", type="float")
      */
     protected $taux;
     /**
      *
      * @ORM\Column(name="applicable_sur", type="decimal", scale=2)
      */
     protected $applicable_sur;
     /**
      *
      * @ORM\Column(name="montant_applique", type="decimal", scale=2)
      */
     protected $montant_applique;

    /**
     * le rang servira lorsque le taux est composé, il sert à dire à quel rang la taxe sera calcule, ex Québec TPS rang 0 (calculé seule) puis TVQ rang 1 (calculé avec le total de base + rangs précédent)
     * @ORM\Column(name="rang", type="integer", nullable=true)
     */
    protected $rang;



    /**
     * Set taux
     *
     * @param decimal $taux
     */
    public function setTaux($taux)
    {
        $this->taux = $taux;
    }

    /**
     * Get taux
     *
     * @return decimal 
     */
    public function getTaux()
    {
        return $this->taux;
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
     * Set rang
     *
     * @param integer $rang
     */
    public function setRang($rang)
    {
        $this->rang = $rang;
    }

    /**
     * Get rang
     *
     * @return integer 
     */
    public function getRang()
    {
        return $this->rang;
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
     * Set nom
     *
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set applicable_sur
     *
     * @param decimal $applicableSur
     */
    public function setApplicableSur($applicableSur)
    {
        $this->applicable_sur = $applicableSur;
    }

    /**
     * Get applicable_sur
     *
     * @return decimal 
     */
    public function getApplicableSur()
    {
        return $this->applicable_sur;
    }

    /**
     * Set montant_applique
     *
     * @param decimal $montantApplique
     */
    public function setMontantApplique($montantApplique)
    {
        $this->montant_applique = $montantApplique;
    }

    /**
     * Get montant_applique
     *
     * @return decimal 
     */
    public function getMontantApplique()
    {
        return $this->montant_applique;
    }
    /**
     * Get montant_applique
     *
     * @return decimal
     */
    public function getMontantAppliqueFormate()
    {
        return \money_format("%i", $this->montant_applique);
    }
}