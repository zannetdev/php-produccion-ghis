<?php

class Creditos extends Controller {

	function __construct() {
		parent::__construct();
	}
	
	function index() {
        $this->view->js = array('creditos/js/index_creditos.js');
		$this->view->render('creditos/index', false);
	}
	function all(){
		$this->model->all();
	}
	function crea_historial(){
		$this->model->crea_historial($_POST);
	}

}