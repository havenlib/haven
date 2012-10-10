<?php

namespace Evocatio\Bundle\PosBundle\Entity;

class Panier {

    private $lignes_item;
    private $total;
    private $devise;

    public function getLinesItem() {
        return $this->lignes_item;
    }

    public function setLinesItem($lignes_item) {
        return $this->lignes_item = $lignes_item;
    }

    public function addLigneItem(LigneItem $ligne_item) {
        $this->lignes_item[] = $ligne_item;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }
    
    public function getDevise(){
        return $this->devise;
    }
    
    public function setDevise($devise){
        $this->devise = $devise;
    }

}
