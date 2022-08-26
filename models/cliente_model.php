<?php
class Cliente_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}
    public function get_colores()
    {
        return $this->db->query("SELECT * FROM tm_insumo WHERE id_categoria = 12 AND estado = 'a'")->fetchAll(PDO::FETCH_OBJ);
    }
   
    public function get_modelos()
    {
        return $this->db->query("SELECT * FROM tm_modelo WHERE estado = 'a'")->fetchAll(PDO::FETCH_OBJ);
    }
    public function empresa(){
        return $this->db->query("SELECT * FROM tm_ajuste")->fetch(PDO::FETCH_OBJ);
    }
    public function crea_pedido($request){
        $id_apc = Session::get('id_apc');
        $id_modelo = $request['id_modelo'];
        $id_cliente = $request['id_cliente'];
        $color = $request['color'];
        $observaciones = $request['observaciones'];
        $metodo = 5;
        $total_compra = $request['total_compra'];
        $monto = 0.00;
        $estado = 'pp';
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
                $estado = 'pc';
                break;
        }
        $fecha = date('Y-m-d H:i:s');
        $cod_transac = 'GHIS' . substr(time(), 0, 6) . substr(str_shuffle($metodo_pago), 0, 4);
        $cod_pago = 'GHIS' . date('Ymdhis') . substr(str_shuffle($metodo_pago), 0, 4);
        $sql = $this->db->query("INSERT INTO tm_pedido (id_pedido, id_apc, id_modelo, id_cliente, estado, fecha)
       VALUES(null, {$id_apc}, {$id_modelo}, {$id_cliente}, 'pc','{$fecha}') ");
        if ($sql) {
            $json = json_encode($request['tallas']);
            $id_pedido = $this->db->lastInsertId();
            $detalle = $this->db->query("INSERT INTO tm_detalle_pedido (id_pedido, json_tallas, color, observacion)
        VALUES({$id_pedido}, '{$json}', '{$color}', '{$observaciones}')");
            if ($metodo != '4' && $metodo != '5') {
                if ($detalle) {
                    $pago = $this->db->query("INSERT INTO tm_pago 
            (id_pago, id_pedido, id_apc, metodo_pago,monto, total, transaccion_id, foto, fecha, estado, cod_pago, json_response)
            VALUES(null, {$id_pedido}, {$id_apc}, '{$metodo}','{$total_compra}','{$total_compra}', '{$cod_transac}', null, '{$fecha}', '{$estado}', '{$cod_pago}', null)");
                      response_function('Pedido creado, puedes verificar a la cola de pedidos para que puedas mandarlo a producción', 1);
                    }
            } else {
                if ($metodo == '5') {
                    $pago = $this->db->query("INSERT INTO tm_pago 
                (id_pago, id_pedido, id_apc, metodo_pago,monto, total, transaccion_id, foto, fecha, estado, cod_pago, json_response)
                VALUES(null, {$id_pedido}, {$id_apc}, '{$metodo}','{$monto}','{$total_compra}', '{$cod_transac}', 'ps', '{$fecha}', '{$estado}', '{$cod_pago}', null)");
                    if ($pago) {
                        $id_pago = $this->db->lastInsertId();
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
	public function mispedidos(){
        $id_cliente = Session::get('usuid');
        $c = $this->db->query("SELECT * FROM tm_pedido as p WHERE p.id_cliente = {$id_cliente} ORDER BY p.fecha ASC")->fetchAll(PDO::FETCH_OBJ);
        foreach($c as $k => $d){
            $c[$k]->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);
            if($c[$k]->{'pago'}->metodo_pago == 5){
                $c[$k]->{'pago'}->{"credito"} = $this->db->query("SELECT * FROM tm_credito WHERE id_pago =  {$c[$k]->{'pago'}->id_pago}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'pago'}->{"credito"}->{'historial'} = $this->db->query("SELECT * FROM tm_historial_credito WHERE id_credito = {$c[$k]->pago->credito->id_credito}")->fetchAll(PDO::FETCH_OBJ);
            }
        }
        return_data_json($c);
    }
    public function detalle_pedido($id)
    {
        $c = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);
        $c->{"pago"} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$c->id_pedido}")->fetch(PDO::FETCH_OBJ);
        $c->{"modelo"} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$c->id_modelo}")->fetch(PDO::FETCH_OBJ);
        $c->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$c->id_pedido}")->fetch(PDO::FETCH_OBJ);
        $c->{'cliente'} = $this->db->query("SELECT CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as nombre FROM tm_cliente WHERE id_cliente = {$c->id_cliente}")->fetch(PDO::FETCH_OBJ);
        if($c->pago->metodo_pago == 5){
            $c->{"credito"} = $this->db->query("SELECT * FROM tm_credito WHERE id_pago =  {$c->pago->id_pago}")->fetch(PDO::FETCH_OBJ);
            $c->{'credito'}->{'historial'} = $this->db->query("SELECT * FROM tm_historial_credito WHERE id_credito = {$c->credito->id_credito}")->fetchAll(PDO::FETCH_OBJ);
        }
        return $c;
    }
}
