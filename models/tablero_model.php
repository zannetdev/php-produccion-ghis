<?php
class Tablero_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function get_data(){
        $id_usu = Session::get('usuid');
        $c = $this->db->query("SELECT * FROM tm_apertura WHERE estado = 'a' AND fecha_cierre IS NULL")->fetch(PDO::FETCH_OBJ);
        $c->{'clientes_registrados'} = $this->db->query("SELECT COUNT(*) as cantidad_clientes FROM tm_cliente")->fetch(PDO::FETCH_OBJ);
        $c->{'pedidos_activos'} = $this->db->query("SELECT COUNT(*) as pedidos_activos FROM tm_pedido WHERE id_apc = {$c->id_apc} AND estado = 'a' ")->fetch(PDO::FETCH_OBJ);
        $c->{'pagos'} =  $this->db->query("SELECT 
        IFNULL(SUM(case when metodo_pago LIKE '1' THEN total END), 0.00) as pago_efectivo,
        IFNULL(SUM(case when metodo_pago LIKE '2' THEN total END), 0.00) as pago_credito,
        IFNULL(SUM(case when metodo_pago LIKE '3' THEN total END), 0.00) as pago_debito,
        IFNULL(SUM(case when metodo_pago LIKE '5' THEN total END), 0.00) as pago_parcial,
        IFNULL(SUM(case when metodo_pago LIKE '6' THEN total END), 0.00) as pago_internet
        FROM tm_pago WHERE id_apc = {$c->id_apc}")->fetch(PDO::FETCH_OBJ);    
        $c->{'usuarios_registrados'} = $this->db->query("SELECT COUNT(*) as cantidad_usuarios FROM tm_usuario WHERE id_usuario <> {$id_usu}")->fetch(PDO::FETCH_OBJ);
        $c->{'ventas'} = $this->db->query("SELECT COUNT(*) as cantidad_ventas FROM tm_pedido WHERE estado = 'p' AND id_apc = {$c->id_apc} ")->fetch(PDO::FETCH_OBJ);
        $c->{'ultimos_usuarios'} = $this->db->query("SELECT * FROM tm_cliente WHERE estado = 'a' LIMIT 10")->fetchAll(PDO::FETCH_OBJ);
        return $c;
    }
    public function get_apertura()
    {
        return $this->db->query("SELECT * FROM tm_apertura WHERE  fecha_cierre IS NULL AND monto_cierre IS NULL AND estado <> 'c'")->fetch(PDO::FETCH_OBJ);
    }
   
}
