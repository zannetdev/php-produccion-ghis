<?php

class Fact_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_pedido($id = null)
    {
        $id != null ? '' : exit();
        $c = $this->db->query("SELECT * FROM tm_pedido WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);
        $c->{'cliente'} = $this->db->query("SELECT nombre, apellido_paterno, apellido_materno, email, telefono FROM tm_cliente WHERE id_cliente = {$c->id_cliente}")->fetch(PDO::FETCH_OBJ);
        $c->{'detalle'} = $this->db->query("SELECT * FROM tm_detalle_pedido WHERE id_pedido  = {$id}")->fetch(PDO::FETCH_OBJ);
        $c->{'producto'} = $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$c->id_modelo}")->fetch(PDO::FETCH_OBJ);
        $c->{'pago'} = $this->db->query("SELECT * FROM tm_pago WHERE id_pedido = {$id}")->fetch(PDO::FETCH_OBJ);
        return $c ? $c : false;
    }
    public function crrl()
    {
        $c = $this->db->query("SELECT COUNT(*) as c FROM crrl")->fetch(PDO::FETCH_OBJ);
        return '00000' . ($c->c + 1);
    }
    public function new_correlativo()
    {
        $c = $this->db->query("INSERT INTO crrl (id, descr) VALUES (null, 'x')");
    }
    public function new_billing_queue(array $data)
    {
        $id_pago = $data['id_pago'];
        $fecha_envio = date('Y-m-d H:i:s');
        $cdr_response = $data['cdr_route'];
        $xml_response = $data['xml_response'];
        $status_sunat = $data['status_sunat'];
        $type_fact = $data['type_fact'];
        $msj = $type_fact == 1 ? 'Boleta Emitida Correctamente' : 'Factura Emitida Correctamente';
        $stm = $this->db->prepare("INSERT INTO tm_facturado (id, id_pago, fecha_envio,
        cdr_response, xml_response, status_sunat, type_fact) VALUES (null, ?, ?, ?, ?, ?, ?)");
        if ($stm->execute(array($id_pago, $fecha_envio, $cdr_response, $xml_response, $status_sunat, $type_fact))) {
            response_function($msj, 1);
        }
    }
    public function get_ven()
    {
        $c = $this->db->query("SELECT id_pago, id_pedido, total, fecha FROM tm_pago WHERE sunat_status = 'b' AND (metodo_pago = '1' OR metodo_pago = '2'  OR metodo_pago = '3')")->fetchAll(PDO::FETCH_OBJ);
        return_data_json($c);
    }
    public function get_docs()
    {
        return $this->db->query("SELECT * FROM tm_documento WHERE id_documento IN (1, 2)")->fetchAll(PDO::FETCH_OBJ);
    }
    public function change_status($id_pedido)
    {
        $u = $this->db->query("UPDATE tm_pago SET sunat_status = '-' WHERE id_pedido = {$id_pedido}");
    }
    public function get_sunat()
    {
        $c = $this->db->query("SELECT * FROM tm_facturado ORDER BY fecha_envio desc")->fetchAll(PDO::FETCH_OBJ);
        return_data_json($c);
    }
}
