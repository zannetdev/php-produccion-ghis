<?php
check_role(array(1, 2));
class Inventario extends Controller
{

    function __construct()
    {
        parent::__construct();
    }
    function index()
    {
        header('Location: ' . URL);
    }
    function modelos()
    {
        $this->view->js = array('inventario/js/all_modelos.js');
        $this->view->render('inventario/modelos', false);
    }
    function materiales()
    {
        $this->view->catg = $this->model->get_catg_inventario();
        $this->view->js = array('inventario/js/all_materiales.js');
        $this->view->render('inventario/materiales', false);
    }
    function get_catg_modelos()
    {
        $this->model->catg_modelos();
    }
    function get_modelos()
    {
        $this->model->get_modelos($_POST);
    }
    function get_inventario()
    {
        $this->model->get_inventario($_POST);
    }
    function delete($id = null)
    {
        $id == null ? exit('ERROR') : '';
        $this->model->delete($id);
    }
    function get_inventario_catg()
    {
        $this->model->get_inventario_catg($_POST);
    }
    function crud_inventario()
    {
        if ($_POST) {
            if ($_POST['id_insumo'] == "") {
                $this->model->insert_ins($_POST);
            } else {
                $this->model->edita_ins($_POST);
            }
        }
    }
    function editar($id)
    {
        $this->view->id_modelo = $id;
        $this->view->js = array('inventario/js/editar_modelo.js');
        $this->view->render('inventario/editar/modelo', false);
    }
    function imprimir($id)
    {
        $this->view->render('inventario/imprimir/modelo', true);
    }
    function catg_crud()
    {
        if ($_POST) {
            if ($_POST['id_categoria'] == "") {
                $this->model->insert_catg_modelo($_POST);
            } else {
                $this->model->edita_catg_model($_POST);
            }
        }
    }
    function crud_modelo($process, $id_modelo = '')
    {
        $this->view->process = $process;
        $this->view->categoria = $this->model->get_catg_modelos();
        $this->view->insumos = $this->model->inventario();
        if ($process == 'agrega') {
            $this->view->js = array('inventario/crud/js/modelo_crud.js');
            $this->view->render('inventario/crud/modelo', false);
        } else {
            if ($process == 'edita') {
                if ($id_modelo != '') {
                    $request_modelo = $this->model->get_specific_model($id_modelo);
                    if ($request_modelo) {
                        $this->view->id_modelo = $id_modelo;
                        $this->view->js = array('inventario/crud/js/modelo_crud.js');
                        $this->view->render('inventario/crud/modelo', false);
                    } else {
                        header('Location : ' . URL);
                    }
                } else {
                    header('Location : ' . URL);
                }
            } else {
                header('Location : ' . URL);
            }
        }
    }
    function get_info_modelo($id)
    {
        $this->model->get_specific_model($id);
    }
    function modelo_crud($process,  $id_modelo = '')
    {
        if ($process == 'agrega') {
            $this->model->agrega_modelo($_POST);
        } else {
            if ($process == 'edita') {
                $this->model->edita_modelo($_POST, $id_modelo);
            }
        }
    }
    public function get_data_model()
    {
        if ($_POST) {
            $id = $_POST['id'];
            $c = $this->model->get_specific_model($id);
            $route  =  str_replace(URL, '', $c->imagen);
            $c->{'img_ext'} = pathinfo($route, PATHINFO_EXTENSION);
            $c->{'img_name'} = pathinfo($route, PATHINFO_FILENAME);
            $c->{'img_size'} = filesize($route);
            $c->{'img_route'} = $route;
            return_data_json($c);
        }
    }
}
