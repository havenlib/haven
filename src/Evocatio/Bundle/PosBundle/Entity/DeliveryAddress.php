<?php

namespace Evocatio\Bundle\PosBundle\Entity;

class DeliveryAddress {

    protected $address;
    protected $address2;
    protected $country;
    protected $code_postal;
    protected $ville;
    protected $state;

    /**
     * Set address
     *
     * @param string $address
     */
    public function setAddress($address) {
        $this->address = $address;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Set address2
     *
     * @param string $address2
     */
    public function setAddress2($address2) {
        $this->address2 = $address2;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2() {
        return $this->address2;
    }

    /**
     * Set ville
     *
     * @param string $ville
     */
    public function setVille($ville) {
        $this->ville = $ville;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille() {
        return $this->ville;
    }

    /**
     * Set code_postal
     *
     * @param string $codePostal
     * @return Postal
     */
    public function setCodePostal($codePostal) {
        $this->code_postal = $codePostal;

        return $this;
    }

    /**
     * Get code_postal
     *
     * @return string 
     */
    public function getCodePostal() {
        return $this->code_postal;
    }

    /**
     * Set country
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\Country $country
     * @return Postal
     */
    public function setCountry(\Evocatio\Bundle\PersonaBundle\Entity\Country $country = null) {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\Country 
     */
    public function getCountry() {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param Evocatio\Bundle\PersonaBundle\Entity\State $state
     * @return Postal
     */
    public function setState(\Evocatio\Bundle\PersonaBundle\Entity\State $state = null) {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return Evocatio\Bundle\PersonaBundle\Entity\State 
     */
    public function getState() {
        return $this->state;
    }

}