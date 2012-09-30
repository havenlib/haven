<?php

namespace Evocatio\Bundle\PosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * liste des taxes connus, et de leurs application
 * Le rang 0 est applicable mais non cummulable,
 * Tous ce qui a un rang non null est composé ex: TPS: rang 1, TVQ rang 2 , on peut pense à un spécial pour 0, le rang sinon commence à 1
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Evocatio\Bundle\PosBundle\Entity\TaxRepository")
 */
class Tax {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
     /**
     * @ORM\ManyToOne(targetEntity="Evocatio\Bundle\PersonaBundle\Entity\State", inversedBy="translations")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $state;


    /**
     * @ORM\Column(name="nom", type="string", length=8)
     */
    protected $nom;

    /**
     * @ORM\Column(name="taux", type="float", nullable=false)
     */
    protected $taux;

    /**
     * le rang servira lorsque le taux est composé, il sert à dire à quel rang la taxe sera calcule, ex Québec TPS rang 0 (calculé seule) puis TVQ rang 1 (calculé avec le total de base + rangs précédent)
     * @ORM\Column(name="rang", type="integer", nullable=true)
     */
    protected $rang;


    
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
     * Set state
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\State $state
     */
    public function setState(\Evocatio\Bundle\PersonaBundle\Entity\State $state)
    {
        $this->state = $state;
    }

    /**
     * Get state
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }
}