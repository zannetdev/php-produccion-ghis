<?php

class Pedidos_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_colores()
    {
        return $this->db->query("SELECT * FROM tm_insumo WHERE id_categoria = 12 AND estado = 'a'")->fetchAll(PDO::FETCH_OBJ);
    }
    public function get_clientes()
    {
        return $this->db->query("SELECT * FROM tm_cliente WHERE estado = 'a'")->fetchAll(PDO::FETCH_OBJ);
    }
    public function get_modelos()
    {
        return $this->db->query("SELECT * FROM tm_modelo WHERE estado = 'a'")->fetchAll(PDO::FETCH_OBJ);
    }
    public function get_docs(){
        return $this->db->query("SELECT * FROM tm_documento WHERE estado = 'a'")->fetchAll(PDO::FETCH_OBJ);
    }
    public function crear_pedido($request)
    {
        $id_apc = Session::get('id_apc');
        $id_modelo = $request['id_modelo'];
        $id_cliente = $request['id_cliente'];
        $color = $request['color'];
        $observaciones = $request['observaciones'];
        $metodo = $request['metodo_pago'];
        $igv = $_SESSION['empresa']->igv;
        $total_compra = $request['total_compra'];
        $monto = $request['monto_recibido'];
        $cod_transacx = $request['cod_transaccion'];
        $subtotal = $request['subtotal'];
        $total_igv = $request['igv_total'];
        $estado = 'c';
        switch ($metodo) {
            case '1':
                $metodo_pago = 'EFECTIVO';
                break;
            case '2':
                $metodo_pago = 'TARJETACREDITO';
                break;
            case '3':
                $metodo_pago = 'TARJETADEBITO';
                break;
            case '4':
                $metodo_pago = 'SINPAGO';
                break;
            case '5':
                $metodo_pago = 'ACREDITO';
                $estado = 'a';
                break;
        }
        $fecha = date('Y-m-d H:i:s');
        $cod_transac = 'GHIS' . substr(time(), 0, 6) . substr(str_shuffle($metodo_pago), 0, 4);
        $cod_pago = 'GHIS' . date('Ymdhis') . substr(str_shuffle($metodo_pago), 0, 4);
        $sql = $this->db->query("INSERT INTO tm_pedido (id_pedido, id_apc, id_modelo, id_cliente, estado, fecha)
       VALUES(null, {$id_apc}, {$id_modelo}, {$id_cliente}, 'c','{$fecha}') ");
        if ($sql) {
            $json = json_encode($request['tallas']);
            $id_pedido = $this->db->lastInsertId();
            $detalle = $this->db->query("INSERT INTO tm_detalle_pedido (id_pedido, json_tallas, color, observacion)
        VALUES({$id_pedido}, '{$json}', '{$color}', '{$observaciones}')");
            if ($metodo != '4' && $metodo != '5') {
                if ($detalle) {
                    if ($metodo == '1') {
                        $pago = $this->db->query("INSERT INTO tm_pago 
                        (id_pago, id_pedido, id_apc, metodo_pago,monto, igv, subtotal, total, transaccion_id, foto, fecha, estado, cod_pago, json_response)
                        VALUES(null, {$id_pedido}, {$id_apc}, '{$metodo}','{$total_compra}', '{$total_igv}', '{$subtotal}' ,'{$total_compra}', '{$cod_transac}', null, '{$fecha}', '{$estado}', '{$cod_pago}', null)");
                        response_function('Pedido creado, puedes verificar a la cola de pedidos para que puedas mandarlo a producción', 1);
                    } else {
                        $pago = $this->db->query("INSERT INTO tm_pago 
                        (id_pago, id_pedido, id_apc, metodo_pago,monto,igv, subtotal, total, transaccion_id, foto, fecha, estado, cod_pago, json_response)
                        VALUES(null, {$id_pedido}, {$id_apc}, '{$metodo}','{$total_compra}','{$total_igv}', '{$subtotal}','{$total_compra}', '{$cod_transacx}', null, '{$fecha}', '{$estado}', '{$cod_pago}', null)");
                        response_function('Pedido creado, puedes verificar a la cola de pedidos para que puedas mandarlo a producción', 1);
                    }
                }
            } else {
                if ($metodo == '5') {
                    if($total_compra == $monto){
                        $S = 'c';
                    }else{
                        $S = 'pc';
                    }
                    $pago = $this->db->query("INSERT INTO tm_pago 
                (id_pago, id_pedido, id_apc, metodo_pago,monto,igv, subtotal, total, transaccion_id, foto, fecha, estado, cod_pago, json_response)
                VALUES(null, {$id_pedido}, {$id_apc}, '{$metodo}','{$monto}','{$total_igv}', '{$subtotal}','{$total_compra}', '{$cod_transac}', null, '{$fecha}', '{$estado}', '{$cod_pago}', null)");
                    if ($pago) {
                        $id_pago = $this->db->lastInsertId();
                        $this->db->query("UPDATE tm_pedido SET estado = '{$S}' WHERE id_pedido = {$id_pedido}");
                        $cred = $this->db->query("INSERT INTO tm_credito (id_credito, id_pago, fecha_inicio, fecha_fin) 
                        VALUES(null, {$id_pago}, '{$fecha}', null)");
                        response_function('Pedido creado, puedes verificar a la cola de pedidos para que puedas mandarlo a producción', 1);
                    }
                } else {
                    if ($metodo == '4') {
                        response_function('Pedido creado, puedes verificar a la cola de pedidos para que puedas mandarlo a producción', 1);
                    }
                }
            }
        }
    }
    public function crear_proceso($request)
    {
        $id = $request['id'];
        $area = 1;
        $x = $this->db->query("UPDATE tm_pedido SET estado = 'p' WHERE id_pedido = {$id}");
        $c = $this->db->query("INSERT INTO tm_proceso (id_proceso, id_pedido, id_area, estado)
        VALUES(null, '{$id}', '{$area}', 'a')");
        if ($c) {
            response_function('Pedido mandado a producción, puedes verificar en su respectiva area.', 1);
        }
    }
    public function cambia_estado_pedido($id, $estado)
    {
        $c = $this->db->query("UPDATE tm_pedido SET estado = '{$estado}' WHERE id_pedido = '{$id}'");
        $pedido = $this->db->query("SELECT id_pedido FROM tm_pedido WHERE id_pedido = '{$id}'");
        $c = $this->db->query("UPDATE tm_pago SET estado = '{$estado}'");
        if ($c) {
            $estado = $estado == 'c' ? 'el pedido se mando a la cola de pedidos de producción' : 'El pedido se ha denegado';
            response_function($estado, 1);
        } else {
            response_function('Error', -10);
        }
    }
}
