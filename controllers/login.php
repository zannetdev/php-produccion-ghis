<?php
$v = Session::get('usuid') ? redirect_role($_SESSION['rol'])   : '';

class Login extends Controller {
	function __construct() {
		parent::__construct();	
	}
	
	function index() 
	{	
		$this->view->js = array('login/js/authentication.js');
		$this->view->render('login/index' , false);
	}
	function run_login(){
		$this->model->run_login($_POST);
	}
}