<?php
class Usuario_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function get_usu_area($request)
	{
		$id_usuario = $request['id_usu'];
		$c = $this->db->query("SELECT * FROM v_area WHERE id_usuario = {$id_usuario} ")->fetch(PDO::FETCH_OBJ);
		return_data_json($c);
	}
	public function get_areas()
	{
		return $this->db->query("SELECT * FROM tm_area")->fetchAll(PDO::FETCH_OBJ);
	}
	public function get_clientes()
	{
		$c = $this->db->query("SELECT  * FROM  v_clientes")->fetchAll(PDO::FETCH_OBJ);
		return_data_json($c);
	}
	public function get_empleados()
	{
		$usuid = Session::get('usuid');
		$c = $this->db->query("SELECT  * FROM  v_usuarios WHERE id_usuario <> {$usuid}")->fetchAll(PDO::FETCH_OBJ);
		return_data_json($c);
	}
	public function agrega_usuario($request)
	{
		try {
			$username = $request['usuario'];
			$password = password_hash($request['password'], PASSWORD_BCRYPT);
			$id_doc = $request['tipo_doc'];
			$num_doc = $request['num_doc'];
			$nombre = $request['nombre'];
			$apellido_paterno = $request['apellido_paterno'];
			$apellido_materno = $request['apellido_materno'];
			$num_doc_ruc = $request['num_doc_ruc'];
			$id_rol = $request['id_rol'];
			$genero = $request['genero'];
			$email = $request['email'];
			$telefono = $request['telefono'];
			$estado = 'a';
			$direccion = $request['direccion'];
			$fecha_registro = date('Y-m-d H:i:s');

			$x = $this->db->prepare("SELECT username FROM tm_cliente WHERE username = '{$username}'")->fetchAll(PDO::FETCH_OBJ);
			$x_usuario = $this->db->query("SELECT username FROM tm_usuario WHERE username = '{$username}'")->fetchAll(PDO::FETCH_OBJ);
			if ((!$x) && (!$x_usuario)) {
				$c = $this->db->query("INSERT INTO tm_usuario
				(id_usuario, id_doc, id_rol, id_area, username, password, num_doc,  ruc,
				nombre, apellido_paterno, apellido_materno, genero, email, telefono, estado,
				direccion, fecha_registro, fecha_actividad)
				VALUES(null, {$id_doc}, {$id_rol}, null, '{$username}', '{$password}',  '{$num_doc}', '{$num_doc_ruc}' , '{$nombre}', 
				'{$apellido_paterno}',  '{$apellido_materno}',  '{$genero}',  '{$email}',  '{$telefono}',  '{$estado}',  '{$direccion}',  '{$fecha_registro}', null)");
				if ($c) {
					response_function('Usuario registrado', 1);
				} else {
					response_function('Error al registrar el cliente', -10);
				}
			} else {
				response_function('Este usuario ya existe, intenta con otro', -10);
			}
		} catch (PDOException $e) {
			response_function($e->getMessage(), -10);
		}
	}
	public function actualiza_usuario($request)
	{
		$username = $request['usuario'];
		$password = password_hash($request['password'], PASSWORD_BCRYPT);
		$id_doc = $request['tipo_doc'];
		$id_usuario = $request['id_usuario'];
		$id_rol = $request['id_rol'];
		$num_doc = $request['num_doc'];
		$nombre = $request['nombre'];
		$num_doc_ruc = $request['num_doc_ruc'];
		$apellido_paterno = $request['apellido_paterno'];
		$apellido_materno = $request['apellido_materno'];
		$genero = $request['genero'];
		$email = $request['email'];
		$telefono = $request['telefono'];
		$estado = 'a';
		$direccion = $request['direccion'];
		$last_user = $this->db->query("SELECT username FROM tm_usuario WHERE id_usuario = {$id_usuario} ")->fetch(PDO::FETCH_OBJ);
		$x = $this->db->query("SELECT username FROM tm_cliente WHERE username = '{$username}' AND username <> '{$last_user->username}' ")->fetchAll(PDO::FETCH_OBJ);
		$x_usuario = $this->db->query("SELECT username FROM tm_usuario WHERE username = '{$username}' AND username <> '{$last_user->username}'")->fetchAll(PDO::FETCH_OBJ);
		if ((!$x) && (!$x_usuario)) {
			$c = $this->db->query("UPDATE tm_usuario SET id_doc = {$id_doc}, ruc = '{$num_doc_ruc}', id_rol = {$id_rol}, username = '{$username}', password = '{$password}', num_doc = '{$num_doc}', 
				nombre = '{$nombre}', apellido_paterno = '{$apellido_paterno}', apellido_materno = '{$apellido_materno}', genero = '{$genero}', email = '{$email}', telefono = '{$telefono}', estado = '{$estado}',  direccion = '{$direccion}' WHERE id_usuario = {$id_usuario}");
			if ($c) {
				response_function('Usuario Actualizado', 1);
			} else {
				response_function('Error al actualizar el Usuario', -10);
			}
		} else {
			response_function('Este usuario ya existe, intenta con otro', -10);
		}
	}
	public function agrega_cliente($request)
	{
		try {
			$username = $request['usuario'];
			$password = password_hash($request['password'], PASSWORD_BCRYPT);
			$id_doc = $request['tipo_doc'];
			$num_doc = $request['num_doc'];
			$nombre = $request['nombre'];
			$num_doc_ruc = $request['num_doc_ruc'];
			$apellido_paterno = $request['apellido_paterno'];
			$apellido_materno = $request['apellido_materno'];

			$genero = $request['genero'];
			$email = $request['email'];
			$telefono = $request['telefono'];
			$estado = 'a';
			$direccion = $request['direccion'];
			$fecha_registro = date('Y-m-d H:i:s');

			$x = $this->db->query("SELECT username FROM tm_cliente WHERE username = '{$username}'")->fetchAll(PDO::FETCH_OBJ);
			$x_usuario = $this->db->query("SELECT username FROM tm_usuario WHERE username = '{$username}'")->fetchAll(PDO::FETCH_OBJ);
			if ((!$x) && (!$x_usuario)) {
				$c = $this->db->query("INSERT INTO tm_cliente
				(id_cliente, id_doc, id_rol, username, password, num_doc, ruc,
				nombre, apellido_paterno, apellido_materno, genero, email, telefono, estado,
				 direccion, fecha_registro, fecha_actividad)
				 VALUES(null, {$id_doc}, 4, '{$username}', '{$password}',  '{$num_doc}', '{$num_doc_ruc}' , '{$nombre}', 
				'{$apellido_paterno}',  '{$apellido_materno}',  '{$genero}',  '{$email}',  '{$telefono}',  '{$estado}',  '{$direccion}',  '{$fecha_registro}', null)");
				if ($c) {
					response_function('Cliente registrado', 1);
				} else {
					response_function('Error al registrar el cliente', -10);
				}
			} else {
				response_function('Este usuario ya existe, intenta con otro', -10);
			}
		} catch (PDOException $e) {
			response_function($e->getMessage(), -10);
		}
	}
	public function actualiza_cliente($request)
	{
		$username = $request['usuario'];
		$password = password_hash($request['password'], PASSWORD_BCRYPT);
		$id_doc = $request['tipo_doc'];
		$id_usuario = $request['id_usuario'];
		$num_doc_ruc = $request['num_doc_ruc'];

		$num_doc = $request['num_doc'];
		$nombre = $request['nombre'];
		$apellido_paterno = $request['apellido_paterno'];
		$apellido_materno = $request['apellido_materno'];
		$genero = $request['genero'];
		$email = $request['email'];
		$telefono = $request['telefono'];
		$estado = 'a';
		$direccion = $request['direccion'];
		$last_user = $this->db->query("SELECT username FROM tm_cliente WHERE id_cliente = {$id_usuario} ")->fetch(PDO::FETCH_OBJ);
		$x = $this->db->query("SELECT username FROM tm_cliente WHERE username = '{$username}' AND username <> '{$last_user->username}' ")->fetchAll(PDO::FETCH_OBJ);
		$x_usuario = $this->db->query("SELECT username FROM tm_usuario WHERE username = '{$username}' AND username <> '{$last_user->username}'")->fetchAll(PDO::FETCH_OBJ);
		if ((!$x) && (!$x_usuario)) {
			$c = $this->db->query("UPDATE tm_cliente SET id_doc = {$id_doc}, ruc = '{$num_doc_ruc}', username = '{$username}', password = '{$password}', num_doc = '{$num_doc}', 
				nombre = '{$nombre}', apellido_paterno = '{$apellido_paterno}', apellido_materno = '{$apellido_materno}', genero = '{$genero}', email = '{$email}', telefono = '{$telefono}', estado = '{$estado}',  direccion = '{$direccion}' WHERE id_cliente = {$id_usuario}");
			if ($c) {
				response_function('Cliente Actualizado', 1);
			} else {
				response_function('Error al actualizar el cliente', -10);
			}
		} else {
			response_function('Este usuario ya existe, intenta con otro', -10);
		}
	}
	public function usudataget($tblname, $id)
	{
		if ($tblname == 'tm_cliente') {
			return $this->db->query("SELECT * FROM " . $tblname . " WHERE id_cliente = {$id}")->fetch(PDO::FETCH_OBJ);
		} else {
			return $this->db->query("SELECT * FROM " . $tblname . " WHERE id_usuario = {$id}")->fetch(PDO::FETCH_OBJ);
		}
	}
	public function get_identificaciones()
	{
		return $this->db->query("SELECT * FROM tm_documentos")->fetchAll(PDO::FETCH_OBJ);
	}
	public function roles()
	{
		return $this->db->query("SELECT * FROM tm_rol WHERE id_rol <> 4")->fetchAll(PDO::FETCH_OBJ);
	}
	public function update_status($request)
	{
		$id_usu = $request['id_usu'];
		$tblname = $request['tbl_name'];
		if ($tblname == 'tm_cliente') {
			$c = $this->db->query("UPDATE " . $tblname . " SET estado = 
				CASE estado 
				WHEN 'a' THEN 'b'
				WHEN 'b' THEN 'a' END
				WHERE id_cliente  = {$id_usu}");
		} else {
			$c = $this->db->query("UPDATE " . $tblname . " SET estado = 
			CASE estado 
			WHEN 'a' THEN 'b'
			WHEN 'b' THEN 'a' END
			WHERE id_usuario  = {$id_usu}");
		}
	}
	public function set_area($request)
	{
		$id_usu = $request['usuid'];
		$id_area = $request['id_area'];
		$c = $this->db->query("UPDATE tm_usuario SET id_area = {$id_area} WHERE id_usuario = {$id_usu}");
		if ($c) {
			response_function('Area actualizada', 1);
		} else {
			response_function('Area no actualizada, verifica tu conexión o contacta al programador', 1);
		}
	}
}
