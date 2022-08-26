<?php
check_role(array(3));
class Area extends Controller {
	function __construct() {
		parent::__construct();	
	}
	
	function index() 
	{	
		$this->view->area = $this->model->get_info_area();
		$this->view->js = array('area/js/area.js');
		$this->view->render('area/index' , false);
	}
	function get_pedidos(){
		$this->model->get_pedidos_area();
	}
	function crear_proceso(){
		$this->model->crear_proceso($_POST);
	}
	function mis_trabajos(){
		$this->view->js = array('area/js/all_trabajos.js');
		$this->view->render('area/all/all_trabajos' , false);
	}
	function mis_pedidos(){
		$this->model->mis_pedidos();
	}
	function terminados(){
		$this->view->impresoras = $this->model->areas_imp();
		$this->view->js = array('area/js/all_terminados.js');
		$this->view->render('area/all/all_terminados' , false);
	}
	function produccion($id_detalle){
		$detalle = $this->model->detalle($id_detalle);
		if($detalle){
			$this->view->datos_proceso = $detalle;
			$this->view->js = array('area/js/all_produccion.js');
			$this->view->render('area/all/all_produccion' , false);
		}else{
			header('Location: ' . URL . 'area/mis_trabajos');
		}
	}
	function terminar_pedido(){
		$this->model->terminar_pedido($_POST);
	}
	function all_terminados(){
		$this->model->all_terminados();
	}
	function get_detalle(){
		$this->model->get_detalle($_POST);
	}
	function imprime_pedido($id){
		$pedido = $this->model->get_pedido($id);
		if($pedido){
			$this->view->detalle = $pedido;
			$this->view->render('area/imprimir/ficha_tecnica' , true);
		}else{
			header('Location: ' . URL );
		}
	}
}