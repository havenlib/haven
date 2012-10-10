<?php

namespace Evocatio\Bundle\PosBundle\Entity;

class Panier {

    private $items;

    public function __construct() {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
