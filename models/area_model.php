<?php
class Area_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function get_info_area()
	{
		$usuid = Session::get('usuid');
		return $this->db->query("SELECT * FROM v_area WHERE id_usuario = {$usuid}")->fetch(PDO::FETCH_OBJ);
	}
	public function get_pedidos_area()
	{
		$area = $_SESSION['usuario']->id_area;
		if ($area != '') {
			$d = $this->db->query("SELECT * FROM tm_proceso WHERE id_area = {$area} AND estado <> 't' ")->fetchAll(PDO::FETCH_OBJ);
			return_data_json($d);
		} else {
			response_function('Error, no tienes una area registrada, contactarte con el administrador para que te asigne un area.', -10);
		}
	}
	public function crear_proceso($request)
	{
		$id = $request['id'];
		$id_usu = Session::get('usuid');
		$id_area = $_SESSION['usuario']->id_area;
		$fecha = date('Y-m-d H:i:s');

		$existence = $this->db->query("SELECT id_detalle FROM tm_detalle_proceso WHERE id_proceso = {$id} AND id_area = '{$id_area}'")->fetchAll(PDO::FETCH_OBJ);
		if (!$existence) {
			$x = $this->db->query("UPDATE tm_proceso SET estado = 'p' WHERE id_proceso = {$id}");
			$c = $this->db->query("INSERT INTO tm_detalle_proceso (id_detalle, id_proceso, id_area, id_usuario, fecha_inicio, fecha_fin)
			VALUES(null, {$id}, '{$id_area}', {$id_usu}, '{$fecha}', null)");
			if ($c) {
				response_function('Pedido tomado correctamente, da click en el siguiente botón para ver el detalle de tu pedido <br><br><a class="btn btn-outline-primary" href="' . URL . 'area/mis_trabajos">Mis Trabajos</a> ', 1);
			}
		} else {
			response_function('Error, alguien ya tomó el pedido', -10);
		}
	}
	public function mis_pedidos()
	{
		$id_area = $_SESSION['usuario']->id_area != '' ? $_SESSION['usuario']->id_area : '0';
		$fecha = date('Y-m-d H:i:s');
		$usuid = Session::get('usuid');
		if (!$id_area == '0') {
			$c = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_usuario = {$usuid} AND id_area = {$id_area} AND fecha_fin IS NULL")->fetchAll(PDO::FETCH_OBJ);
			if ($c) {
				foreach ($c as $k => $d) {
					$detalle = $this->db->query("SELECT * FROM tm_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
					$modelo = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$detalle->id_pedido}")->fetch(PDO::FETCH_OBJ);
					$c[$k]->{'modelo'} = $this->db->query("SELECT cod_diseño FROM tm_modelo WHERE id_modelo = {$modelo->id_modelo}")->fetch(PDO::FETCH_OBJ);
				}
			}
			return_data_json($c);
		} else {
			response_function('Error, no tienes un area regisitrada', -10);
		}
	}
	public function detalle($id_detalle)
	{
		$id_area = $_SESSION['usuario']->id_area != '' ? $_SESSION['usuario']->id_area : '0';
		$fecha = date('Y-m-d H:i:s');
		$usuid = Session::get('usuid');
		$c = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_usuario = {$usuid} AND id_area = {$id_area} AND id_detalle = {$id_detalle}")->fetch(PDO::FETCH_OBJ);
		if ($c) {

			$c->{'detalle'} = $this->db->query("SELECT * FROM tm_proceso WHERE id_proceso = {$c->id_proceso}")->fetch(PDO::FETCH_OBJ);
			$c->{'pedido'} = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$c->{'detalle'}->id_pedido}")->fetch(PDO::FETCH_OBJ);
			$c->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$c->{'detalle'}->id_pedido}")->fetch(PDO::FETCH_OBJ);
			$c->{'modelo'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$c->{'pedido'}->id_modelo}")->fetch(PDO::FETCH_OBJ);
		}
		return $c;
	}
	public function terminar_pedido($request){
		$fecha = date("Y-m-d H:i:s");
		$id_proceso = $request['id_proceso'];
		$id_detalle = $request['id_detalle'];
		$c = $this->db->query("UPDATE tm_detalle_proceso SET fecha_fin = '{$fecha}' WHERE id_detalle = {$id_detalle}");
		if($c){
			$proceso = $this->db->query("SELECT * FROM tm_proceso WHERE id_proceso = {$id_proceso}")->fetch(PDO::FETCH_OBJ);
			if($proceso->id_area <= 6){
				$c = $this->db->query("UPDATE tm_proceso SET estado = 't' WHERE id_proceso = {$id_proceso}");
				$c = $this->db->query("INSERT INTO tm_proceso (id_proceso, id_pedido, id_area, estado)
				VALUES(null, {$proceso->id_pedido}, ($proceso->id_area + 1), 'a')");
				if($proceso->id_area == 6){
					$this->db->query("UPDATE tm_pedido SET estado = 't' WHERE id_pedido = {$proceso->id_pedido}");
					response_function('Pedido culminado con exito, puedes imprimir tu comprobante de proceso en el apartado de tus trabajos.', 1);
				}else{
					response_function('Pedido enviado a la siguiente area, puedes imprimir tu comprobante de proceso en el apartado de tus trabajos.', 1);
				}
			}else{
				response_function('Proceso de producción terminado', 1);
			}
		}
	}
	public function areas_imp(){
		$id_area = $_SESSION['usuario']->id_area != '' ? $_SESSION['usuario']->id_area : '0';
		if($id_area != '0'){
			$c = $this->db->query("SELECT imp.nombre_impresora, imp.corte_impresora FROM tm_area_impresoras as ai INNER JOIN tm_impresora AS imp ON ai.id_impresora = imp.id_impresora WHERE ai.id_area = {$id_area} AND imp.estado = 'a'")->fetchAll(PDO::FETCH_OBJ);
			return $c;
		}else{
			return false;
		}
	}
	public function all_terminados(){
		$id_usuario = Session::get('usuid');
		$c = $this->db->query("SELECT * FROM tm_detalle_proceso WHERE id_usuario = {$id_usuario} AND NOT fecha_fin IS NULL")->fetchAll(PDO::FETCH_OBJ);
		foreach($c as $k => $d){
			$c[$k]->{'proceso'} = $this->db->query("SELECT * FROM tm_proceso WHERE id_proceso = {$d->id_proceso}")->fetch(PDO::FETCH_OBJ);
		}
		return_data_json($c);
	}
	public function get_detalle($request)
	{
		$id = $request['id_detalle'];
		$c = $this->db->query("SELECT id_proceso, fecha_inicio, fecha_fin FROM tm_detalle_proceso WHERE id_detalle = {$id}")->fetch(PDO::FETCH_OBJ);
		if($c){
			$p = $this->db->query("SELECT id_pedido FROM tm_proceso WHERE id_proceso = {$c->id_proceso}")->fetch(PDO::FETCH_OBJ);
			$pe = $this->db->query("SELECT id_modelo FROM tm_pedido WHERE id_pedido = {$p->id_pedido}")->fetch(PDO::FETCH_OBJ);
			$c->{'pedido_detalle'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$p->id_pedido}")->fetch(PDO::FETCH_OBJ);
			$c->{'modelo'} = $this->db->query("SELECT cod_diseño, precio FROM tm_modelo WHERE id_modelo = {$pe->id_modelo}")->fetch(PDO::FETCH_OBJ);
			return_data_json($c);
		}else{
			response_function('Ningun registro encontrado', -10);
		}
	}
	public function get_pedido($id){
		$c = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);
		if ($c) {
			$c->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);
			$c->{'modelo'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$c->id_modelo}")->fetch(PDO::FETCH_OBJ);
		}
		return $c;
	}
}
