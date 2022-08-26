<?php
check_role(array(1, 2));

class Tablero extends Controller {
	function __construct() {
		parent::__construct();	
	}
	
	function index() 
	{	
		$apc = $this->model->get_apertura();
		if($apc){
			$this->view->data = $this->model->get_data();
		}else{
			$this->view->data = false;
		}
		$this->view->js = array('tablero/js/tablero.js');
		$this->view->render('tablero/index' , false);
	}
	
}