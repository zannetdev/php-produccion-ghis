<?php
class Service_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function fetch_pedidos()
    {
        $id_apc = Session::get('id_apc');

        $id = $_SESSION['usuario']->id_area != '' ? $_SESSION['usuario']->id_area : '0';
        if ($id == '0' && Session::get('rol') == 3) {
            response_function('Error, no estás registrado en ningún area, favor de decirle al encargado que te registre en una', -10);
        } else {
            $c = $this->db->query("SELECT COUNT(*) as countp FROM v_pedido WHERE id_area = '{$id}' AND id_apc = {$id_apc}")->fetch(PDO::FETCH_OBJ);
            if ($c->countp > $_SESSION['count']) {
                Session::set('count', $c->countp);
                response_function('Nuevos pedidos en el area, favor de verificar dando click aquí', 1);
            } else {
                Session::set('count', $c->countp);
                response_function('Sin pedidos nuevos', -10);
            }
        }
    }
    public function UpdateLastActivity()
    {
        $tbl = $_SESSION['rol'] != 4 ? 'tm_usuario' : 'tm_cliente';
        $cond = $_SESSION['rol'] != 4 ? 'id_usuario' : 'id_cliente';
        $fecha = date('Y-m-d H:i:s');
        $id = Session::get('usuid');
        $c = $this->db->query("UPDATE " . $tbl . " SET fecha_actividad = '{$fecha}' WHERE " . $cond . " = {$id}");
    }
    public function get_pedidos()
    {
        $id_apc = Session::get('id_apc');
        $id_usu = Session::get('usuid');
        if (Session::get('rol') == 3) {
            // LISTA PROCESOS
            $id_area = $_SESSION['usuario']->id_area != '' ? $_SESSION['usuario']->id_area : false;
            if ($id_area) {
                $c = $this->db->query("SELECT * FROM tm_proceso WHERE id_area = {$id_area} AND estado <> 'p' AND estado <> 't' ")->fetchAll(PDO::FETCH_OBJ);
                if ($c) {
                    foreach ($c as $k => $d) {
                        $detalle = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
                        if ($detalle) {
                            $c[$k]->{'detalle'} = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
                            $c[$k]->{'detalle'}->{'usuario'} = $this->db->query("SELECT * FROM tm_usuario WHERE id_usuario = {$c[$k]->detalle->id_usuario}")->fetch(PDO::FETCH_OBJ);
                        }
                        $c[$k]->{'detalle'}->{'pedido'} = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$c[$k]->id_pedido}")->fetch(PDO::FETCH_OBJ);
                        $c[$k]->{'detalle'}->{'cliente'} = $this->db->query("SELECT * FROM tm_cliente WHERE id_cliente = {$c[$k]->detalle->pedido->id_cliente}")->fetch(PDO::FETCH_OBJ);
                        $c[$k]->{'detalle'}->{'modelo'} = $this->db->query("SELECT cod_diseño FROM tm_modelo WHERE id_modelo = {$c[$k]->detalle->pedido->id_modelo}")->fetch(PDO::FETCH_OBJ);
                    }
                }
            } else {
                response_function('No estás registrado a nungún area de producción, contactate con el administrador', -10);
            }
        } else {
            if (Session::get('rol') == 1 || Session::get('rol') == 2) {
                //ES ADMINISTRADOR, PUEDE VER TODOS LOS PEDIDOS
                $c = $this->db->query("SELECT * FROM v_pedido_admin WHERE  estado = 'c' ")->fetchAll(PDO::FETCH_OBJ);
            } else {
                if (Session::get('rol') == 4) {
                    // lista por que es cliente
                }
            }
        }

        return_data_json($c);
    }
    public function get_pc()
    {
        $id_apc = Session::get('id_apc');
        $id_usu = Session::get('usuid');
        if (Session::get('rol') == 3) {
            // LISTA PROCESOS
            $id_area = $_SESSION['usuario']->id_area != '' ? $_SESSION['usuario']->id_area : false;
            if ($id_area) {
                $c = $this->db->query("SELECT * FROM tm_proceso WHERE id_area = {$id_area} AND estado <> 'p' AND estado <> 't' ")->fetchAll(PDO::FETCH_OBJ);
                if ($c) {
                    foreach ($c as $k => $d) {
                        $detalle = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
                        if ($detalle) {
                            $c[$k]->{'detalle'} = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
                            $c[$k]->{'detalle'}->{'usuario'} = $this->db->query("SELECT * FROM tm_usuario WHERE id_usuario = {$c[$k]->detalle->id_usuario}")->fetch(PDO::FETCH_OBJ);
                        }
                        $c[$k]->{'detalle'}->{'pedido'} = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$c[$k]->id_pedido}")->fetch(PDO::FETCH_OBJ);
                        $c[$k]->{'detalle'}->{'cliente'} = $this->db->query("SELECT * FROM tm_cliente WHERE id_cliente = {$c[$k]->detalle->pedido->id_cliente}")->fetch(PDO::FETCH_OBJ);
                        $c[$k]->{'detalle'}->{'modelo'} = $this->db->query("SELECT cod_diseño FROM tm_modelo WHERE id_modelo = {$c[$k]->detalle->pedido->id_modelo}")->fetch(PDO::FETCH_OBJ);
                    }
                }
            } else {
                response_function('No estás registrado a nungún area de producción, contactate con el administrador', -10);
            }
        } else {
            if (Session::get('rol') == 1 || Session::get('rol') == 2) {
                //ES ADMINISTRADOR, PUEDE VER TODOS LOS PEDIDOS
                $c = $this->db->query("SELECT * FROM v_pedido_admin WHERE estado = 'pc'")->fetchAll(PDO::FETCH_OBJ);
            } else {
                if (Session::get('rol') == 4) {
                    // lista por que es cliente
                }
            }
        }

        return_data_json($c);
    }
    public function sum_apc($request)
    {
        $monto = $request['monto'];
        $id_apc = Session::get('id_apc');
        $c = $this->db->query("UPDATE tm_apertura SET monto_sistema = (monto_sistema + {$monto}) WHERE id_apc = {$id_apc}");
        if ($c) {
            $e = mdi_return('mdi mdi-class', md5('ajhaudsh'));
            echo md5($e);
        }
    }
    public function upload_image($route)
    {
        $c = $this->db->query("INSERT INTO tm_tmp_images (id_tmp, route) VALUES(null, '{$route}')");
        return $this->db->lastInsertId();
    }
    public function delete_image($id)
    {
        $c = $this->db->query("SELECT route FROM tm_tmp_images WHERE id_tmp = {$id}")->fetch(PDO::FETCH_OBJ);
        return $c->route;
    }
    public function update_status($request)
    {
        $filter = $request['filter'];
        $tblname = $request['tbl_name'];
        $c = $this->db->query("UPDATE " . $tblname . " SET estado = 
				CASE estado 
				WHEN 'a' THEN 'b'
				WHEN 'b' THEN 'a' END
				WHERE id_modelo  = {$filter}");
    }
    public function get_nombre_cliente($request)
    {
        $id_1 = $request['id_cliente1'];
        $c = $this->db->query("");
        $c->{'cliente1'} = $this->db->query("SELECT id_cliente, nombre FROM tm_cliente WHERE id_cliente = {$id_1}")->fetch(PDO::FETCH_OBJ);
        return_data_json($c);
    }
    public function get_procesos($request)
    {
        $c = $this->db->query("SELECT * FROM tm_proceso WHERE estado <> 't'")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c as $k => $d) {
            $c[$k]->{'area'} = $this->db->query("SELECT * FROM tm_area WHERE id_area = {$d->id_area}")->fetch(PDO::FETCH_OBJ);
            $detalle = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
            if ($detalle) {
                $c[$k]->{'detalle'} = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'detalle'}->{'usuario'} = $this->db->query("SELECT * FROM tm_usuario WHERE id_usuario = {$c[$k]->detalle->id_usuario}")->fetch(PDO::FETCH_OBJ);
            }
            $c[$k]->{'detalle'}->{'pedido'} = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$c[$k]->id_pedido}")->fetch(PDO::FETCH_OBJ);
            $c[$k]->{'detalle'}->{'modelo'} = $this->db->query("SELECT cod_diseño FROM tm_modelo WHERE id_modelo = {$c[$k]->detalle->pedido->id_modelo}")->fetch(PDO::FETCH_OBJ);
        }
        return_data_json($c);
    }
    public function update_session()
    {
        $id = Session::get('usuid');
        if ($id) {
            $empresa = $this->db->query("SELECT * FROM tm_ajuste")->fetch(PDO::FETCH_OBJ);
            $impresora_principal = $this->db->query("SELECT i.nombre_impresora as nombre FROM tm_ajuste as aj 
            INNER JOIN tm_impresora as i ON aj.id_impresora = i.id_impresora")->fetch(PDO::FETCH_OBJ);
            $usuario = $this->db->query("SELECT * FROM tm_usuario WHERE id_usuario = {$id}")->fetch(PDO::FETCH_OBJ);
            $_SESSION['impresora_principal'] = $impresora_principal->nombre;
            $_SESSION['empresa'] = $empresa;
            $_SESSION['usuario'] = $usuario;
            var_dump($impresora_principal);
        }
    }
    public function get_info_pedido($id)
    {
        $c = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);

        $c->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$c->id_pedido}")->fetch(PDO::FETCH_OBJ);
        $c->{'modelo'} = $this->db->query("SELECT cod_diseño FROM tm_modelo WHERE id_modelo = {$c->id_modelo}")->fetch(PDO::FETCH_OBJ);

        return_data_json($c);
    }
    public function cambia_imagen_pago($request)
    {
        $id_tmp = $request['id_tmp'];
        $id_pago = $request['id_pago'];
        $img = $this->db->query("SELECT route FROM tm_tmp_images WHERE id_tmp = {$id_tmp}")->fetch(PDO::FETCH_OBJ);
        if ($img->route) {
            $c = $this->db->query("UPDATE tm_pago SET foto = '{$img->route}' WHERE id_pago = {$id_pago}");
            if ($c) {
                response_function('Comprobante de pago subido correctamente', 1);
            } else {
                response_function('Hubo un error', -10);
            }
        } else {
            response_function('Imagen no encontrada, favor de recargar la página y vuelve a subirla', -10);
        }
    }
}
