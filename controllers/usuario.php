<?php
check_role(array(1, 2));

class Usuario extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        header('Location: ' . URL . 'usuario/clientes');
    }
    function clientes()
    {
        $this->view->js = array('usuario/js/all_cliente.js');
        $this->view->render('usuario/cliente', false);
    }
    function usuario_process($proceso, $tipo, $usuid = '')
    {
        if ($tipo == "") {
            header('Location: ' . URL . 'usuario/clientes');
        } else {
            if ($tipo == 'empleado' || $tipo == 'cliente') {
                if ($proceso == 'edita' && $usuid  == '') {
                    header('Location: ' . URL . 'usuario/clientes');
                    exit();
                }
                $tipo == 'empleado' ? $title = $proceso . ' empleado' : $title = $proceso . ' cliente';
            } else {
                header('Location: ' . URL . 'usuario/clientes');
            }
        }
        if ($proceso == 'edita' && $usuid != "") {

            $this->view->usuid = $usuid;
        }
        $this->view->proceso = $proceso;
        $this->view->tipo_proceso = $proceso;
        $this->view->tipo_usuario = $tipo;
        $this->view->roles = $this->model->roles();
        $this->view->title = $title;
        $this->view->js = array('usuario/js/all_crud.js');
        $this->view->identificaciones  = $this->model->get_identificaciones();
        $this->view->render('usuario/crud/all_usuario', false);
    }
    function empleados()
    {
        $this->view->areas = $this->model->get_areas();
        $this->view->js = array('usuario/js/all_empleado.js');
        $this->view->render('usuario/empleado', false);
    }
    function get_clientes()
    {
        $this->model->get_clientes();
    }
    function get_empleados()
    {
        $this->model->get_empleados();
    }
    function request_data()
    {
        if ($_POST) {
            $_POST['tipo'] == 'empleado' ? $tbl = 'tm_usuario' : $tbl = 'tm_cliente';
            $usudata = $this->model->usudataget($tbl, $_POST['id_usuario']);
            if($usudata){
                return_data_json($usudata);
            }else{
                response_function('Usuario no encontrado', -10);
            }
        }
    }
    function crud_usuario()
    {
        if ($_POST) {
            if ($_POST['id_rol'] == '-1') {
                //CLIENTE
                if ($_POST['process'] == 'edita') {
                    $this->model->actualiza_cliente($_POST);
                } else {
                    $this->model->agrega_cliente($_POST);
                }
            } else {
                //EMPLEADO O ADMINISTRADOR
                //CLIENTE
                if ($_POST['process'] == 'edita') {
                    $this->model->actualiza_usuario($_POST);
                } else {
                    $this->model->agrega_usuario($_POST);
                }
            }
        }
    }
    function update_status(){
        $this->model->update_status($_POST);
    }
    function set_area(){
        $this->model->set_area($_POST);
    }
}
