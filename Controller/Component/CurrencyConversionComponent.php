<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CurrencyConversionComponent
 *
 * @author jcastillo
 */
App::uses('Component', 'Controller');
App::import('Controller', 'CurrencyConversions.CurrencyConversions');
class CurrencyConversionComponent extends Component {
    
     private $c;
     
     function __construct() {
     	$this->c = new CurrencyConversionsController;
     }
    
     public function refreshData() {        
     	$this->c->refreshData();        
     }
     
     public function currencyExchange($origin, $destination, $value) {        
     	return $this->c->currencyExchange($origin, $destination, $value);
     }  
	 
	 public function currencyExchangeId($origin, $destination, $value) {
	 	return $this->c->currencyExchangeId($origin, $destination, $value);
	 }

     public function getActivas() {
         return $this->c->getActivas();
     }
   
}



