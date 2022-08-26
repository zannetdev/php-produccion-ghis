<?php
class Informes_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get_aperturas(){
        $c = $this->db->query("SELECT * FROM v_apertura")->fetchAll(PDO::FETCH_OBJ);
        return_data_json($c);
    }
    public function get_ventas(){
        $c = $this->db->query("SELECT * FROM v_ventas WHERE tipo_pago <> 'A CRÉDITO'")->fetchAll(PDO::FETCH_OBJ);
        return_data_json($c);
    }
    public function empresa(){
        return $this->db->query("SELECT * FROM tm_ajuste")->fetch(PDO::FETCH_OBJ);
    }
    public function get_creditos(){
        $c = $this->db->query("SELECT * FROM tm_credito")->fetchAll(PDO::FETCH_OBJ);
        foreach($c as $k => $d){
            $c[$k]->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pago = '{$d->id_pago}'")->fetch(PDO::FETCH_OBJ);
            $pedido = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = '{$c[$k]->{'pago'}->id_pedido}'")->fetch(PDO::FETCH_OBJ);
            $apc = $this->db->query("SELECT * FROM tm_apertura WHERE id_apc = '{$c[$k]->{'pago'}->id_apc}'")->fetch(PDO::FETCH_OBJ);
            $c[$k]->{'cliente'} = $this->db->query("SELECT CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as nombre FROM tm_cliente WHERE id_cliente = '{$pedido->id_cliente}'")->fetch(PDO::FETCH_OBJ);
            $c[$k]->{'encargado'} = $this->db->query("SELECT CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as nombre FROM tm_usuario WHERE id_usuario = '{$apc->id_usuario}'")->fetch(PDO::FETCH_OBJ);
            $c[$k]->{'historial'} = $this->db->query("SELECT * FROM tm_historial_credito WHERE id_credito = '{$d->id_credito}'")->fetchAll(PDO::FETCH_OBJ);
        }
        return_data_json($c);
    }
    public function modelos_vendidos(){
        $c = $this->db->query("SELECT id_modelo, cod_diseño, precio FROM tm_modelo")->fetchAll(PDO::FETCH_OBJ);
        foreach($c as $k => $d){
            $total = 0;
            $pedido = $this->db->query("SELECT id_pedido FROM tm_pedido WHERE id_modelo = {$d->id_modelo}")->fetchAll(PDO::FETCH_OBJ);
            if($pedido){
               foreach($pedido as $l => $x){
                $json = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$x->id_pedido}")->fetch(PDO::FETCH_OBJ);
                $json_tallas = json_decode($json->json_tallas);
                foreach ($json_tallas as $a => $b){
                    $total = $total + $b->cantidad;
                }
               }
            }
            $c[$k]->{'cantidad'} = $total;
        }
        return_data_json($c);
    }
    public function get_pedidos(){
        $c = $this->db->query("SELECT * FROM tm_pedido WHERE estado = 'p' OR estado = 't'")->fetchAll(PDO::FETCH_OBJ);
        foreach($c as $k => $d){
            $c[$k]->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);
            $c[$k]->{'proceso'} = $this->db->query("SELECT * FROM tm_proceso WHERE id_pedido = {$d->id_pedido}")->fetchAll(PDO::FETCH_OBJ);
            if($c[$k]->{'proceso'}){
                foreach($c[$k]->{'proceso'} as $a => $b){
                    $c[$k]->{'proceso'}[$a]->{'detalle'} = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_proceso = {$b->id_proceso}")->fetch(PDO::FETCH_OBJ);
                }
            }
            $c[$k]->{'modelo'} = $this->db->query("SELECT cod_diseño FROM tm_modelo WHERE id_modelo = {$d->id_modelo}")->fetch(PDO::FETCH_OBJ);
            $c[$k]->{'cliente'} = $this->db->query("SELECT CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as nombre FROM tm_cliente WHERE id_cliente = '{$d->id_cliente}'")->fetch(PDO::FETCH_OBJ);
        }
        return_data_json($c);
    }
    public function get_empleados(){
        $c = $this->db->query("SELECT CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as nombre, id_area, id_usuario FROM tm_usuario WHERE id_rol = 3")->fetchAll(PDO::FETCH_OBJ);
        return_data_json($c);
    }
    public function general_reporte($request){
        $fecha = date_create($request['fecha']);
        $fecha =  date_format($fecha,"ym");
        $comodin ='%%'.$fecha . '%'; 
        $c = $this->db->query("SELECT id_apc FROM tm_apertura WHERE cod_reporte LIKE '{$comodin}'")->fetchAll(PDO::FETCH_OBJ);
        if ($c) {
            response_function('Reporte encontrado', 1);
        } else {
            response_function('Reporte no encontrado, intenta con otro mes', -10);
        }
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
    public function apc_idv($id_apc){
        $c = $this->db->query("SELECT * FROM tm_apertura WHERE id_apc = {$id_apc}")->fetch(PDO::FETCH_OBJ);
        $c->{'encargado'} = $this->db->query("SELECT  CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as nombre FROM tm_usuario WHERE id_usuario = {$c->id_usuario}")->fetch(PDO::FETCH_OBJ);
        $c->{'ventas'}->{'efectivo'} = $this->db->query("SELECT ped.id_pedido, ped.id_modelo, ped.id_cliente FROM tm_pedido AS ped INNER JOIN tm_pago as pago ON ped.id_pedido = pago.id_pedido WHERE ped.id_apc = {$id_apc} AND pago.metodo_pago = 1")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c->ventas->efectivo as $k => $d){
            $c->ventas->efectivo[$k]->{'modelo'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$d->id_modelo}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->efectivo[$k]->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->efectivo[$k]->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);

        }
        $c->{'ventas'}->{'t_credito'} =  $this->db->query("SELECT ped.id_pedido, ped.id_modelo, ped.id_cliente FROM tm_pedido AS ped INNER JOIN tm_pago as pago ON ped.id_pedido = pago.id_pedido WHERE ped.id_apc = {$id_apc} AND pago.metodo_pago = 2")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c->ventas->t_credito as $k => $d){
            $c->ventas->t_credito[$k]->{'modelo'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$d->id_modelo}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->t_credito[$k]->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->t_credito[$k]->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);

        }
        $c->{'ventas'}->{'t_debito'} =  $this->db->query("SELECT ped.id_pedido, ped.id_modelo, ped.id_cliente FROM tm_pedido AS ped INNER JOIN tm_pago as pago ON ped.id_pedido = pago.id_pedido WHERE ped.id_apc = {$id_apc} AND pago.metodo_pago = 3")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c->ventas->t_debito as $k => $d){
            $c->ventas->t_debito[$k]->{'modelo'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$d->id_modelo}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->t_debito[$k]->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->t_debito[$k]->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);

        }
        $c->{'ventas'}->{'s_pago'} =  $this->db->query("SELECT ped.id_pedido, ped.id_modelo, ped.id_cliente FROM tm_pedido AS ped INNER JOIN tm_pago as pago ON ped.id_pedido = pago.id_pedido WHERE ped.id_apc = {$id_apc} AND pago.metodo_pago = 4")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c->ventas->s_pago as $k => $d){
            $c->ventas->s_pago[$k]->{'modelo'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$d->id_modelo}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->s_pago[$k]->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->s_pago[$k]->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);

        }
        $c->{'ventas'}->{'a_credito'} =  $this->db->query("SELECT ped.id_pedido, ped.id_modelo, ped.id_cliente FROM tm_pedido AS ped INNER JOIN tm_pago as pago ON ped.id_pedido = pago.id_pedido WHERE ped.id_apc = {$id_apc} AND pago.metodo_pago = 5")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c->ventas->a_credito as $k => $d){
            $c->ventas->a_credito[$k]->{'modelo'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$d->id_modelo}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->a_credito[$k]->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);
            $c->ventas->a_credito[$k]->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);

        }
        return $c;
    }
    public function empleado_reporte($request){

        $xfecha = date('Y-m-d H:i:s',strtotime($request['ifecha']));
        $ffecha = date('Y-m-d H:i:s',strtotime($request['ffecha']));
        $id = $request['id'];
        $sc = $this->db->prepare("SELECT * FROM tm_detalle_proceso WHERE id_usuario = ? AND (fecha_inicio >= ? AND fecha_inicio <= ?)");
        if($sc->execute(array($id,$xfecha, $ffecha))){
            $c = $sc->fetchAll(PDO::FETCH_OBJ);

            foreach($c as $k => $d){
                $c[$k]->{'proceso'} = $this->db->query("SELECT * FROM tm_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'pedido'} = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$c[$k]->{'proceso'}->id_pedido}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'pedido'}->{'modelo'} = $this->db->query("SELECT cod_diseño, id_modelo, precio, imagen FROM tm_modelo WHERE id_modelo = {$c[$k]->{'pedido'}->id_modelo}")->fetch(PDO::FETCH_OBJ);
                $c[$k]->{'pedido'}->{'detalle'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$c[$k]->{'proceso'}->id_pedido}")->fetch(PDO::FETCH_OBJ);
            }
            return $c;
        }else{
            return false;
        }
    }
    public function empleado($id){
        $c = $this->db->query("SELECT  CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) as nombre FROM tm_usuario WHERE id_usuario = {$id}")->fetch(PDO::FETCH_OBJ);
        $c->{'area'} = $this->db->query("SELECT * FROM v_area WHERE id_usuario = {$id}")->fetch(PDO::FETCH_OBJ);

        return $c;
    }
}
