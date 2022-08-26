<?php
class Auth extends Controller {
	function __construct() {
		parent::__construct();	
	}
    function AuthLogout(){
        sleep(0.5);
        Session::destroy();
        echo 1;
    }
}