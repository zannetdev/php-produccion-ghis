<?php
check_role(array(1, 2, 3, 4));

class Service extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function update_pedidos()
	{
		if ($_SESSION['rol'] == 3) {
			$this->model->fetch_pedidos();
		}
	}
	function update_messages()
	{
	}
	function UpdateLastActivity()
	{
		$this->model->UpdateLastActivity();
	}
	function get_pedidos()
	{
		$this->model->get_pedidos();
	}
	function sum_apc()
	{
		if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3) {
			$this->model->sum_apc($_POST);
		} else {
			echo 'No hay nada';
		}
	}
	function upload_image()
	{

		if ($_FILES['file']['size'] <= 2 * MB) {
			$archivo = $_FILES['file']['name'];
			if (isset($archivo) && $archivo != "") {

				$tipo = $_FILES['file']['type'];
				$extension = pathinfo($archivo, PATHINFO_EXTENSION);
				$temp = $_FILES['file']['tmp_name'];
				$archivo = 'modelo-' . time() . '.' . $extension;
				if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")))) {
					response_function("Error. La extensión o el tamaño de los archivos no es correcta.<br/>
					- Se permiten archivos .gif, .jpg, .png. y de 2 MB como máximo.", -10);
				} else {
					$route = 'public/assets/modelos/images/';
					if (move_uploaded_file($temp, $route . $archivo)) {
						//Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
						chmod($route . $archivo, 0777);
						$id = $this->model->upload_image(URL . $route . $archivo);
						return_data_json($id);
					} else {
						response_function('Error al subir  el archivo',  -10);
					}
				}
			}
		} else {
			response_function('Error, el archivo excede el tamaño permitido, solo menos de 2 MB', -10);
		}
	}
	public function delete_image()
	{
		$id = $_POST['id'];
		$route = $this->model->delete_image($id);
		if ($route) {
			$str = str_replace(URL, '', $route);
			if (unlink($str)) {
				// file was successfully deleted
				response_function('Eliminada correctamente', 1);
			} else {
				// there was a problem deleting the file
				response_function('Error al eliminar, favor  de recargar la página', -10);
			}
		}
	}
	public function update_status()
	{
		$this->model->update_status($_POST);
	}

	public function get_nombre_cliente()
	{
		$this->model->get_nombre_cliente($_POST);
	}
	function get_phrase()
	{
		
	}
	public function get_procesos()
	{
		$this->model->get_procesos($_POST);
	}
	public function sunat_ruc($ruc){
		$curl  = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			CURLOPT_HTTPHEADER => array(
			  'Referer: http://apis.net.pe/api-ruc',
			  'Authorization: Bearer ' . API_DNI_KEY
			),
		  ));
		  $response = curl_exec($curl);
		  curl_close($curl);
		  $empresa = json_decode($response);
		  return_data_json($empresa);  
	}
	function update_session(){
		$this->model->update_session();
	}
	function get_pc(){
		$this->model->get_pc();	
	}
	function get_info_pedido($id){
		$this->model->get_info_pedido($id);
	}
	function sube_comprobante(){
		if ($_FILES['file']['size'] <= 2 * MB) {
			$archivo = $_FILES['file']['name'];
			if (isset($archivo) && $archivo != "") {

				$tipo = $_FILES['file']['type'];
				$extension = pathinfo($archivo, PATHINFO_EXTENSION);
				$temp = $_FILES['file']['tmp_name'];
				$archivo = 'comprobante' . time() . '.' . $extension;
				if (!((strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")))) {
					response_function("Error. La extensión o el tamaño de los archivos no es correcta.<br/>
					- Se permiten archivos .gif, .jpg, .png. y de 2 MB como máximo.", -10);
				} else {
					$usu = Session::get('usuid');
					$route = 'public/assets/comprobantes/user/'.md5($usu).'/';
					if (!file_exists($route)) {
						mkdir($route, 0777);
					}
					if (move_uploaded_file($temp, $route . $archivo)) {
						//Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
						chmod($route . $archivo, 0777);
						$id = $this->model->upload_image(URL . $route . $archivo);
						return_data_json($id);
					} else {
						response_function('Error al subir  el archivo',  -10);
					}
				}
			}
		} else {
			response_function('Error, el archivo excede el tamaño permitido, solo menos de 2 MB', -10);
		}
	}
	function cambia_imagen_pago(){
		$this->model->cambia_imagen_pago($_POST);
	}
}
