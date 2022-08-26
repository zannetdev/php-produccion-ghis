<?php
class Detalle_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function detalle_pedido($id)
    {
        $c = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);
        $c->{"pago"} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$c->id_pedido}")->fetch(PDO::FETCH_OBJ);
        $c->{"modelo"} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$c->id_modelo}")->fetch(PDO::FETCH_OBJ);
        $c->{'detalle_pedido'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido = {$c->id_pedido}")->fetch(PDO::FETCH_OBJ);
        if($c->pago->metodo_pago == 5){
            $c->{"credito"} = $this->db->query("SELECT * FROM tm_credito WHERE id_pago =  {$c->pago->id_pago}")->fetch(PDO::FETCH_OBJ);
            $c->{'credito'}->{'historial'} = $this->db->query("SELECT * FROM tm_historial_credito WHERE id_credito = {$c->credito->id_credito}")->fetchAll(PDO::FETCH_OBJ);
        }
        return $c;
    }
}
