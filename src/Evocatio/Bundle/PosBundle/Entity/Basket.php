<?php

namespace Evocatio\Bundle\PosBundle\Entity;

class Basket {

    private $line_items;
    private $devise;

    public function getLineItems() {
        return $this->line_items;
    }

    public function setLineItems($line_items) {
        return $this->line_items = $line_items;
    }

    public function addLineItem(LineItem $line_item) {
        $this->line_items[] = $line_item;
    }

    public function getTotal() {
    }

    public function getDevise(){
        return $this->devise;
    }
    
    public function setDevise($devise){
        $this->devise = $devise;
    }

}
