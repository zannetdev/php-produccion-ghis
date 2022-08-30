<?php

class Fact_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_pedido($id = null){
        $id != null ? '' : exit();
        $c = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);
        $c->{'cliente'} = $this->db->query("SELECT nombre, apellido_paterno, apellido_materno, email, telefono FROM tm_cliente WHERE id_cliente = {$c->id_cliente}")->fetch(PDO::FETCH_OBJ);
        $c->{'detalle'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido  = {$id}")->fetch(PDO::FETCH_OBJ);
        $c->{'producto'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$c->id_modelo}")->fetch(PDO::FETCH_OBJ);
        $c->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);
        return $c ? $c : false;
    }
    public function crrl(){
        $c = $this->db->query("SELECT COUNT(*) as c FROM crrl")->fetch(PDO::FETCH_OBJ);
        return '00000'.($c->c + 1);
    }
    public function new_correlativo(){
        $c = $this->db->query("INSERT INTO crrl (id, descr) VALUES (null, 'x')");
    }
}
