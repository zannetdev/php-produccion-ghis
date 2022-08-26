<?php

class Detalle extends Controller {

	function __construct() {
		parent::__construct();
	}
    function pedido($id){
        $detalle =  $this->model->detalle_pedido($id);
        if($detalle){
            $this->view->detalle = $detalle;
            $this->view->js = array('detalle/js/pedido_detalle.js');
            $this->view->render('detalle/pedido', false);
        }else{
            header('Location: '.  URL . '');
        }
        
    }
}