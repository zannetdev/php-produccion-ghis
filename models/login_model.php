<?php

class Login_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function run_login($request)
	{
		$pwd = $request['password'];
		$username = sanitize($request['username'], 'text');
		$sql_cliente = "SELECT * FROM tm_cliente WHERE username = '$username' OR email = '$username' ";
		$sql_usuario = "SELECT * FROM tm_usuario WHERE username = '$username' OR email = '$username' ";
		$data = $this->db->query($sql_cliente)->fetch(PDO::FETCH_OBJ) ? $this->db->query($sql_cliente)->fetch(PDO::FETCH_OBJ) : $this->db->query($sql_usuario)->fetch(PDO::FETCH_OBJ);
		if ($data) {
			if (password_verify($pwd, $data->password)) {
				if ($data->estado == 'a') {
					$empresa = $this->db->query("SELECT * FROM tm_ajuste")->fetch(PDO::FETCH_OBJ);
					$rol_id = $data->id_usuario ? $data->id_rol : '4';
					$id_usu = $data->id_usuario ? $data->id_usuario : $data->id_cliente;
					Session::set('rol', $rol_id);
					Session::set('username', $data->username);
					Session::set('usuid', $id_usu);
					$_SESSION['empresa'] = $empresa;
					$_SESSION['usuario'] = $data;
					switch ($rol_id) {
						case 1:
							$rol_name = 'Super';
							break;
						case 2: //
							$rol_name = 'Administrador';

							break;
						case 3: //
							$rol_name = 'Empleado';

							break;
						case 4: //\
							$rol_name = 'Cliente';

							break;
					}
					//Creamos la sesion de pedidos, la cual se actualiza usando el controlador service
					$id = $_SESSION['usuario']->id_area != '' ? $_SESSION['usuario']->id_area : '0';
					if($id != '0' && Session::get('rol') == 3){
						$cx = $this->db->query("SELECT COUNT(*)as countp FROM v_pedido WHERE id_area = '{$id}'")->fetchAll(PDO::FETCH_OBJ);
						Session::set('count', intval($cx->countp));
					}
					Session::set('rol_name', $rol_name);
					Session::set('loggedIn', true);
					response_function('Bienvenido de nuevo ' . $data->username . '', 1);
				}else{
					response_function('Esta cuenta se encuentra deshabilitada.' . $data->username . '', 1);
				}
			} else {
				response_function('Usuario o contraseña incorrectos, favor de verificar los campos y volver a intentar.', -10);
			}
		} else {
			response_function('Usuario o contraseña incorrectos, favor de verificar los campos y volver a intentar.', -10);
		}
	}
}
