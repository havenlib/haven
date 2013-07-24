<?php
namespace Evocatio\Bundle\CmsBundle\Lib;

class MenuRoute{
    protected $_route;
    protected $_route_params;
    
    public function __construct($route = null, array $params = array()) {
        $this->_route = $route;
        $this->_route_params = $params;
    }
    
    public function addParameter($param){
        $this->_route_params[] = $param;
        
        return $this;
    }
    
    public function setParameters($params){
        $this->_route_params = $params;
        
        return $this;
    }
    
    public function getParameters(){
        return $this->_route_params;
    }
    
    public function setRoute($route){
        $this->_route = $route;
        
        return $this;
    }
    
    public function getRoute(){
        return $this->_route;
    }
    
    
}
