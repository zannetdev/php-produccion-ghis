<?php
check_role(array(1, 2));
class Apertura extends Controller {
	function __construct() {
		parent::__construct();	
	}
	
	function index() 
	{	
		$this->view->apertura = $this->model->get_apertura();
		$this->view->js = array('sistema/js/all_apertura.js');
		$this->view->render('sistema/apertura' , false);
	}
	function ap_nueva(){
		$this->model->nueva_apertura($_POST);
	}
	function cierra_sistema(){
		$this->model->cierra_sistema($_POST);
	}
	

}