<?php

namespace Evocatio\Bundle\PosBundle\Entity;

class LigneItem {

    private $item;
    private $quantity;
    private $sub_total;

    public function getItem() {
        return $this->item;
    }

    public function setItem($item) {
        $this->item = $item;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getSubTotal() {
        return $this->sub_total;
    }

    public function setSubTotal($sub_total) {
        $this->sub_total = $sub_total;
    }

}

?>
