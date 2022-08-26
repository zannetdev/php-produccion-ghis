<?php
check_role(array(1, 2));
class Informes extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->view->js = array('informes/js/informes_index.js');
        $this->view->render('informes/index', false);
    }
    function aperturas(){
        $this->view->js = array('informes/js/finanzas/all_aperturas.js', 'informes/js/informes_index.js');
        $this->view->render('informes/all/finanzas/all_aperturas', false);
    }
    function ventas_caja(){
        $this->view->js = array('informes/js/finanzas/all_ventas.js', 'informes/js/informes_index.js');
        $this->view->render('informes/all/finanzas/all_ventas', false);
    }
    function ventas_pagina(){
        $this->view->js = array('informes/js/informes_index.js');
        $this->view->render('informes/index', false);
    }
    function creditos_finanzas(){
        $this->view->js = array('informes/js/finanzas/all_creditos.js', 'informes/js/informes_index.js');
        $this->view->render('informes/all/finanzas/all_creditos', false);
    }
    function por_modelo(){
        $this->view->js = array('informes/js/produccion/all_modelos.js', 'informes/js/informes_index.js');
        $this->view->render('informes/all/produccion/all_modelos', false);
    }
    function todas_produccion(){
        $this->view->js = array('informes/js/produccion/all_todas.js', 'informes/js/informes_index.js');
        $this->view->render('informes/all/produccion/all_todas', false);
    }
    function por_empleado(){
        $this->view->js = array('informes/js/reportes/all_empleado.js', 'informes/js/informes_index.js');
        $this->view->render('informes/all/reportes/all_empleado', false);
    }
    function por_area(){
        $this->view->js = array('informes/js/reportes/all_area.js', 'informes/js/informes_index.js');
        $this->view->render('informes/all/reportes/all_area', false);
    }
    function reporte_general($fecha){
        if($fecha){
            $this->view->render('services/print/reportes/reporte_general', true);
        }else{
            header('Location: ' . URL . 'informes/');
        }
    }
    // CONSULTAS SQL
    function get_aperturas(){
        $this->model->get_aperturas();
    }
    function get_ventas(){
        $this->model->get_ventas();
    }
    
    function get_creditos(){
        $this->model->get_creditos();
    }
    function modelos_vendidos(){
        $this->model->modelos_vendidos();
    }
    function get_todas(){
        $this->model->get_pedidos();
    }
    function get_empleados(){
        $this->model->get_empleados();
    }
    function general_reporte(){
        $this->model->general_reporte($_POST);
    }
    function imprime_pedido($id){
		$detalle =  $this->model->detalle_pedido($id);
        if($detalle){
			$this->view->empresa = $this->model->empresa();
            $this->view->detalle = $detalle;
            $this->view->render('informes/imprimir/pedido', true);
        }else{
            header('Location: '.  URL . '');
        }
	}
    function reporte_apertura_individual($id){
       $apc =  $this->model->apc_idv($id);
       $this->view->empresa = $this->model->empresa();
       $this->view->detalle = $apc; 
       $this->view->render('informes/imprimir/apertura', true);

    }
    function empleado_reporte($id){
        $ifecha = $_GET["ifecha"];
        $ffecha = $_GET["ffecha"];
        $detalle = $this->model->empleado_reporte(array(
            "id"=>$id, "ifecha"=>$ifecha, "ffecha"=>$ffecha));
       
           if($detalle){
            $this->view->empresa = $this->model->empresa();
            $this->view->empleado = $this->model->empleado($id);
            $this->view->detalle = $detalle;
            $this->view->query = array(
                "id"=>$id, "ifecha"=>$ifecha, "ffecha"=>$ffecha);
            $this->view->render('informes/imprimir/empleado', true);
           }else{
            header('Location: '.  URL . '');

           }
        
    }
    function check_report($type){
        switch($type){
            case 'empleado':
            $detalle = $this->model->empleado_reporte($_POST);
                if($detalle){
                    response_function('',1);
                }else{
                    response_function('',-10);
                }
            break;
        }
    }
}
