<?php
class Control_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function get_status_sistema(){
        $c =  $this->db->query("SELECT * FROM tm_apertura WHERE  fecha_cierre IS NULL AND monto_cierre IS NULL AND estado <> 'c'")->fetch(PDO::FETCH_OBJ);
		if($c){
			Session::set('id_apc', $c->id_apc);
			response_function('Sistema aperturado', 1);

		}else{
			if($_SESSION['id_apc'] != ""){ 
				Session::set('id_apc', '-');
			}else{
				Session::set('id_apc', '-');
			}
			response_function('No hay ninguna apertura detectada, favor de esperar que el encargado abra el sistema', -10);
		}
	}
}
