<?php
class Apertura_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get_apertura()
    {
        return $this->db->query("SELECT * FROM tm_apertura WHERE  fecha_cierre IS NULL AND monto_cierre IS NULL AND estado <> 'c'")->fetch(PDO::FETCH_OBJ);
    }
    public function nueva_apertura($request){
        $a = $this->db->query("SELECT * FROM tm_apertura WHERE  fecha_cierre IS NULL AND monto_cierre IS NULL AND estado <> 'c'")->fetchAll(PDO::FETCH_OBJ);
        if(!$a){
            $code = '10'.date('ymd').'40';
            $id_usuario = Session::get('usuid');
            $date_aper = date('Y-m-d H:i:s');
            $monto_inicial = $request['monto_inicial'];
            $c = $this->db->query("INSERT INTO tm_apertura (id_apc, id_usuario, fecha_apertura, fecha_cierre, monto_inicial, monto_sistema, monto_cierre, cod_reporte, estado)
            VALUES(null, {$id_usuario}, '{$date_aper}', null, '{$monto_inicial}', '{$monto_inicial}', null, '{$code}', 'a')");
            if($c){
                Session::set('id_apc', $this->db->lastInsertId());
                response_function('Sistema aperturado correctamente', 1);
            }
        }else{
            response_function('Apertura ya existente', -10);

        }
       
    }
    public function cierra_sistema($request){
        $monto_inicial = $request['monto_cierre'];
        $date_cierre = date('Y-m-d H:i:s');
        $id_apc = Session::get('id_apc');
        $c = $this->db->query("UPDATE tm_apertura SET fecha_cierre = '{$date_cierre}', monto_cierre = '{$monto_inicial}', estado = 'c' WHERE id_apc = {$id_apc}");
        if($c){
            Session::set('id_apc', '-');
            response_function('Sistema cerrado correctamente', 1);
        }
    }
}
