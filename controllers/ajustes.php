<?php
check_role(array(1, 2));
class Ajustes extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$this->view->js = array('ajustes/js/all_ajustes.js');
		$this->view->render('ajustes/all/all_generales', false);
	}
	function impresoras()
	{
		$this->view->js = array('ajustes/js/all_impresoras.js');
		$this->view->render('ajustes/all/all_impresoras', false);
	}
	function config($request)
	{
		if ($request) {
			$view = '';
			$js = null;
			switch ($request) {
				case 'empresa':
					$view = 'ajustes/all/all_empresa';
					$js = array('ajustes/js/all_empresa.js');
					break;
				case 'redes':
					$view = 'ajustes/all/all_redes';
					$js = array('ajustes/js/all_redes.js');
					break;
				case 'impresoras':
					$view = 'ajustes/all/all_impresoras';
					$js = array('ajustes/js/all_impresoras.js');
					break;
				case 'testing':
					$view = 'ajustes/all/all_pruebas';
					$js = array('ajustes/js/all_test.js');
					break;
				case 'docs':
					$view = 'ajustes/all/all_docs';
					$js = array('ajustes/js/all_docs.js');
					break;
				case 'asign':
					$view = 'ajustes/all/all_asignacion';
					$js = array('ajustes/js/all_asignacion.js');
					break;
				default:
					$view = false;
					break;
			}
			if ($view != '' && $view != false) {
				$this->view->impresoras = $this->model->impresoras();
				$this->view->empresa = $this->model->Empresa();
				$this->view->js = $js;
				$this->view->render($view, false);
			}
		} else {
			header('Location: ' . URL . 'ajustes/');
		}
	}
	function cambia_empresa()
	{
		$this->model->cambia_empresa($_POST);
	}
	function get_empresa()
	{
		return_data_json($this->model->Empresa());
	}
	function cambia_red()
	{
		$this->model->cambiar_red($_POST);
	}
	function imp_get()
	{
		$this->model->imp_get();
	}
	function update_status()
	{
		$this->model->update_status($_POST);
	}
	function crud_impresora()
	{
		if ($_POST) {
			if ($_POST['id_imp'] != '') {
				$this->model->edit_impresora($_POST);
			} else {
				$this->model->add_impresora($_POST);
			}
		}
	}
	function area_permises($id)
	{
		if ($id > 6 || $id < 0) : header('Location: ' . URL . 'ajustes');
		endif;
		//Si todo está bien renderizamos
		$this->view->impresoras = $this->model->impresoras_area();
		$this->view->impresoras_reg = $this->model->get_impresoras_registradas($id);
		$this->view->js = array('ajustes/js/all_detalle_impresora.js');
		$this->view->area = $id;
		$this->view->render('ajustes/all/detail_imp', false);
	}
	function get_imp_reg($id)
	{
		//Trae las impresoras registradas
		$this->model->get_imp_reg($id);
	}
	function elimina_impresora_area()
	{
		$this->model->elimina_impresora_area($_POST);
	}
	function agrega_impresora()
	{
		$this->model->agrega_impresora($_POST);
	}
	function get_docs(){
		$this->model->get_docs();
	}
	function get_info_doc(){
		$this->model->get_info_doc($_POST['id']);
	}
	function save_doc_cfg(){
		$this->model->save_doc_cfg($_POST);
	}
}
