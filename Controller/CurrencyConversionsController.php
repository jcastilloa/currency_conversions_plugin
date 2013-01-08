<?php
App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');
App::uses('Menu','Lib');
App::import('Utility', 'Xml');
/**
 * CurrencyConversions Controller
 *
 * @property CurrencyConversion $CurrencyConversion
 */
class CurrencyConversionsController extends CurrencyConversionsAppController {
	
	public $uses = array('CurrencyConversions.CurrencyConversion');     
        
        
        public function refreshData() {          
                
            try {
                
				$this->loadModel("CurrencyConversion");
				
                $dataSource = $this->CurrencyConversion->getDataSource();
                $dataSource->begin();             
		
				$xmlString = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
				$xmlArray = Xml::toArray(Xml::build($xmlString));				
				$monedas =  $xmlArray['Envelope']['Cube']['Cube']['Cube'];
             
         
		$monedas[] = array('@currency'=>'EUR', '@rate' => '1' );
		       
		foreach ($monedas as $linea_array) {	
                    
                        $o = $this->CurrencyConversion->find('first', array('conditions' => array('CurrencyConversion.dsc' => $linea_array['@currency'])));					
   
                        if (isset($o['CurrencyConversion'])) {
                        $this->CurrencyConversion->id = $o['CurrencyConversion']['id'];
                        } else {
                          $this->CurrencyConversion->create();			
			  $this->CurrencyConversion->set('dsc', $linea_array['@currency']);                                                       
                        }
			$this->CurrencyConversion->set('value', $linea_array['@rate']);
			$this->CurrencyConversion->save();			
			
		}
		
            $dataSource->commit();
                
            } catch (Exception $e) {                    
                     $dataSource->rollback();
            }               
                		
	}
        
        
    public function currencyExchange($origin, $destination, $value) {	
		$this->loadModel("CurrencyConversion");
                $o = $this->CurrencyConversion->find('first', array('conditions' => array('CurrencyConversion.dsc' => $origin)));		
		$d = $this->CurrencyConversion->find('first', array('conditions' => array('CurrencyConversion.dsc' => $destination)));
		//convert origin to euro		
		if (isset($o['CurrencyConversion'])) {
			$eur_o = round(($value / $o['CurrencyConversion']['value']),2);
			//convert to destination		
			$dest =  round(($eur_o * $d['CurrencyConversion']['value']),2);			
			return $dest;
		} else {
			return null;
		}
		
	}
			
	public function currencyExchangeId($origin, $destination, $value) {	
		$this->loadModel("CurrencyConversion");
		
		$this->CurrencyConversion->id = $origin;
		$o_value = $this->CurrencyConversion->field("value");
		$this->CurrencyConversion->id = $destination;
		$d_value = $this->CurrencyConversion->field("value");
		
     	//convert origin to euro		
		if (isset($o_value)) {
			$eur_o = round(($value / $o_value),2);
			//convert to destination		
			$dest =  round(($eur_o * $d_value),2);			
			return $dest;
		} else {
			return null;
		}
					
	}
        
/**
 * index method
 *
 * @return void
 * 
 */ 
	public function index() {
		
	    $conditions = array();  
          
        if (isset($this->params['data']['submit'])) {
            
			if (!empty($this->params['data']['Basica']['dsc'])) {
			$txtdsc = Sanitize::paranoid($this->params['data']['Basica']['dsc']);
			$conditions[] = array('CurrencyConversion.dsc LIKE' => '%'.$txtdsc.'%');
			}
			
		} elseif (isset($this->params['data']['actualizar'])) {
			
			$this->refreshData();
			$this->Session->setFlash(__('Data has been updated sucesfull'));			
			
		}
		
	/*	$xmlString = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';
		$xmlArray = Xml::toArray(Xml::build($xmlString));				
		$monedas =  $xmlArray['Envelope']['Cube']['Cube']['Cube'];	*/
		
		//$a = ($this->currencyExchange("EUR","USD", 5));
		
		//$this->refreshData();
		
		//$this->set('monedas', '');
		
		$this->paginate = array(
		'limit' => 20,
		'currencyConversion' => array('CurrencyConversion.id' => 'DESC'),
		'conditions' => $conditions	);	
				
		$this->CurrencyConversion->recursive = 0;
		$this->set('currencyConversions', $this->paginate());
		
		$menu = new Menu();
		$menu->agregarEnlace('general',  __('Nueva Currency Conversion'), 'currencyConversions', 'add', '');
		$mimenu = $menu->getMenu('general');		
		$this->set('menu', $mimenu);
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->CurrencyConversion->id = $id;		
		
		if (isset($this->params['data']['cancel'])) {		
			$this->redirect(array('action' => 'index'));			
		}		
		
		if (!$this->CurrencyConversion->exists()) {
			throw new NotFoundException(__('Invalid currency conversion'));
		}
		$this->set('currencyConversion', $this->CurrencyConversion->read(null, $id));
		$this->set('id', $id);
		
		$menu = new Menu();
		$menu->agregarEnlace('general', __('Editar Currency Conversion'), 'currencyConversions', 'edit', $id);
		$menu->agregarEnlace('general', __('Volver a lista'), 'currencyConversions', 'index', '');
		$mimenu = $menu->getMenu('general');
		$this->set('menu', $mimenu);
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			if (isset($this->params['data']['cancel'])) {		
					$this->redirect(array('action' => 'index'));		
			}	
			
			$this->CurrencyConversion->loadData();
			
			$sandata = Sanitize::clean($this->request->data, array('encode' => true, 'remove_html' =>true));			
			if ($this->CurrencyConversion->save($sandata)) {
				$this->Session->setFlash(__('The currency conversion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The currency conversion could not be saved. Please, try again.'));
			}
		}

		$menu = new Menu();
		$menu->agregarEnlace('general', __('Volver a lista'), 'currencyConversions', 'index', '');
		$mimenu = $menu->getMenu('general');
		$this->set('menu', $mimenu);
		
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		
		$this->CurrencyConversion->id = $id;
		
		if (isset($this->params['data']['cancel'])) {		
			$this->redirect(array('action' => 'index'));			
		}		
		
		if (!$this->CurrencyConversion->exists()) {
			throw new NotFoundException(__('Invalid currency conversion'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			
			$sandata = Sanitize::clean($this->request->data, array('encode' => true, 'remove_html' =>true));
			if ($this->CurrencyConversion->save($sandata)) {
				$this->Session->setFlash(__('The currency conversion has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The currency conversion could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->CurrencyConversion->read(null, $id);
		}
	
		$menu = new Menu();
		$menu->agregarEnlace('general', __('Volver a lista'), 'currencyConversions', 'index', '');
		$mimenu = $menu->getMenu('general');
		$this->set('menu', $mimenu);
	
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->CurrencyConversion->id = $id;
		if (!$this->CurrencyConversion->exists()) {
			throw new NotFoundException(__('Invalid currency conversion'));
		}
		if ($this->CurrencyConversion->delete()) {
			$this->Session->setFlash(__('Currency conversion deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Currency conversion was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
