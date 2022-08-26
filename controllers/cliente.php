<?php
check_role(array(4));

class Cliente extends Controller {
	function __construct() {
		parent::__construct();	
	}
	
	function index() 
	{	
		$this->view->colores = $this->model->get_colores();
		$this->view->js = array('cliente/js/cliente.js');
		$this->view->render('cliente/index' , false);
	}
	function mis_pedidos(){
		$this->view->js = array('cliente/js/mis_pedidos.js');
		$this->view->render('cliente/mis_pedidos' , false);
	}
	function pedido_create($data)
	{
		if ($data) {
			$data =  json_decode($data); 
			if($data->color != '' && $data->cliente1 != ''){
				$this->view->data = $data;
				$this->view->js = array('cliente/js/pedido_create.js');
				$this->view->modelos = $this->model->get_modelos();
				$this->view->render('cliente/crear', false);
			}else{
				header('Location: '. URL . 'cliente/');
			}
			
		}else{
			header('Location: ' . URL . 'cliente/');
		}
	}
	public function crea_pedido(){
		$this->model->crea_pedido($_POST);
	}
	public function mispedidos(){
		$this->model->mispedidos();
	}
	function imprime_pedido($id){
		$detalle =  $this->model->detalle_pedido($id);
        if($detalle){
			$this->view->empresa = $this->model->empresa();
            $this->view->detalle = $detalle;
            $this->view->render('cliente/imprimir/pedido', true);
        }else{
            header('Location: '.  URL . '');
        }
	}
}