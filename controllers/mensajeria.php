<?php
check_role(array(1, 2, 3, 4));
class Mensajeria extends Controller {
	function __construct() {
		parent::__construct();	
	}
	
	function index() 
	{	
		$this->view->js = array('messenger/js/all_messenger.js');
		$this->view->render('messenger/index' , false);
	}
	
}