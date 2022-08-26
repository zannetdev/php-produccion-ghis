<?php

class Control extends Controller {

	function __construct() {
		parent::__construct();
	}
    function get_status_sistema() {
        $this->model->get_status_sistema();
    }
}