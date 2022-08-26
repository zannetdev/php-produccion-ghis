<?php
class Creditos_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}
    public function all(){
        $c = $this->db->query("SELECT * FROM tm_pago WHERE metodo_pago = '5' AND monto < total")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c as $k => $d){
            $c[$k]->{'pedido'} = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido  = {$d->id_pedido}")->fetch(PDO::FETCH_OBJ);
            $c[$k]->{"credito"} = $this->db->query("SELECT * FROM tm_credito WHERE id_pago =  {$d->id_pago}")->fetch(PDO::FETCH_OBJ);
            $c[$k]->{'credito'}->{'historial'} = $this->db->query("SELECT * FROM tm_historial_credito WHERE id_credito = {$c[$k]->{"credito"}->id_credito}")->fetchAll(PDO::FETCH_OBJ);
        }
        return_data_json($c);
    }
    public function crea_historial($req){

        $monto = $req['monto_abono'];
        $id_credito = $req['id_credito'];
        $credito = $this->db->query("SELECT * FROM tm_credito WHERE id_credito = {$id_credito}")->fetch(PDO::FETCH_OBJ);
        $pago = $this->db->query("SELECT * FROM tm_pago WHERE id_pago = {$credito->id_pago}")->fetch(PDO::FETCH_OBJ);
        $historial = $this->db->query("SELECT * FROM tm_historial_credito WHERE id_credito = {$credito->id_credito}")->fetchAll(PDO::FETCH_OBJ);
        $saldo = 0.00;
        if($historial){
            foreach ($historial as $k => $d){
                $saldo = $saldo + $d->saldo;
            }
        }
        $saldo = $pago - $saldo;
        $is_final_payment = false;
        if($monto >= $saldo){
            $is_final_payment = true;
        }
        $fecha = date('Y-m-d H:i:s');
        $x1 = $this->db->query("UPDATE tm_pago SET monto = (monto + '{$monto}') WHERE id_pago = '{$credito->id_pago}'");
        $c = $this->db->query("INSERT INTO tm_historial_credito (id_historial, id_credito, monto, fecha) VALUES(null, {$id_credito}, '{$monto}', '{$fecha}')");
        if($is_final_payment == true){
            $x = $this->db->query("UPDATE tm_credito SET fecha_fin = '{$fecha}' WHERE id_credito = '{$id_credito}'");
        }
        if ($c) {
            response_function('Pago agregado exitosamente', 1);
        } else {
            response_function('Pago no agregado', -10);
        }
    }
}
