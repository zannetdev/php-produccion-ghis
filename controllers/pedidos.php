<?php
check_role(array(1, 2));
class Pedidos extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view->colores = $this->model->get_colores();
		$this->view->clientes = $this->model->get_clientes();
		$this->view->js = array('pedidos/js/pedidos_all.js');
		$this->view->render('pedidos/index', false);
	}
	function pedidos(){
		$this->view->js = array('pedidos/js/pedido_detalle.js');
		$this->view->render('pedidos/details', false);
	}
	function proceso(){
		$this->view->js = array('pedidos/js/all_procesos.js');
		$this->view->render('pedidos/procesos', false);
	}
	function por_confirmar(){
		$this->view->js = array('pedidos/js/pedidos_pc.js');
		$this->view->render('pedidos/por_confirmar', false);
	}
	function pedido_create($data)
	{
		if ($data) {
			$data =  json_decode($data); 
			if($data->color != '' && $data->cliente1){
				$this->view->data = $data;
				$this->view->docs = $this->model->get_docs();
				$this->view->js = array('pedidos/js/pedido_create.js');
				$this->view->modelos = $this->model->get_modelos();
				$this->view->render('pedidos/create', false);
			}else{
				header('Location: '. URL . 'pedidos');
			}
			
		}else{
			header('Location: ' . URL . 'pedidos/');
		}
	}
	function crear_pedido(){
		$this->model->crear_pedido($_POST);
	}
	function crear_proceso(){
		$this->model->crear_proceso($_POST);
	}
	function cambia_estado_pedido($id, $estado){
		$this->model->cambia_estado_pedido($id, $estado);
	}
}
