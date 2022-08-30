<?php
class Ajustes_Model extends Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function Empresa()
    {
        return $this->db->query("SELECT * FROM tm_ajuste")->fetch(PDO::FETCH_OBJ);
    }
    public function cambia_empresa($request, $file = null)
    {
        $flag_prod = isset($request['flag_produc']) ? 'a' : 'b';
        $flag_sunat = isset($request['flag_sunat']) ? 'a' : 'b';
        $empresa = $this->db->query("SELECT * FROM tm_ajuste")->fetch(PDO::FETCH_OBJ);
        $type = $flag_prod == 'a' ? 'prod' : 'beta';
        $cx = $empresa->ruta_certificado != '' ? $empresa->ruta_certificado : null; 
        if(($file != null) || ($cx != null)){
            $ruta = $file != null ? uploadCert($file, $type) :  $cx ;
            $ruc = $request['ruc'];
            $empresa = $request['empresa'];
            $direccion = $request['direccion'];
            $ubigeo = $request['ubigeo'];
            $igv = $request['igv'];
            $distrito = $request['distrito'];
            $provincia = $request['provincia'];
            $departamento = $request['ubigeo'];
            $usu_sol = $request['usuario_sol'];
            $clave_sol = $request['clave_sol'];
            $pwd_cert = $request['pwd_certificado'];
            if ($ruc != '' && $empresa != '' && $direccion != '' && $ubigeo != '' && $distrito != '' && $provincia != '' && $departamento != '' && $usu_sol != '' 
            && $clave_sol != '' && $pwd_cert != '') {
                $stm = $this->db->prepare("UPDATE tm_ajuste SET ruc_empresa = ?,
                 nombre_empresa = ?, direccion = ?, ubigeo = ?, distrito = ?, provincia = ?, departamento = ?, 
                 flag_prod = ?, flag_sunat = ?, usu_sol = ?, clave_sol = ?, pwd_certificado = ?, ruta_certificado = ?, igv = ?");
                if ($stm->execute(
                    array($ruc, $empresa, $direccion, $ubigeo, $distrito, $provincia, $departamento, $flag_prod, $flag_sunat, $usu_sol, $clave_sol, $pwd_cert, $ruta, $igv)
                    )) {

					$_SESSION['empresa'] = $empresa;
                    response_function('Empresa actualizada exitosamente.', 1);

                } else {
                    response_function('Empresa no actualizada', -10);
                }
            }else{
                response_function('Rellena todos los campos', -10);
            }
        }else{
            response_function('Favor de subir un certificado', -10);
        }
       
    }
    public function impresoras()
    {
        return $this->db->query("SELECT * FROM tm_impresora")->fetchAll(PDO::FETCH_OBJ);
    }
    public function cambiar_red($request)
    {
        $ip = $request['ip'];
        $id_imp = $request['id_imp'];
        $stm = $this->db->query("UPDATE tm_ajuste SET id_impresora = {$id_imp}, ip_principal = '{$ip}' ");
        if ($stm) {
            response_function('Redes actualizadas', 1);
        } else {
            response_function('Redes no actualizadas', -10);
        }
    }
    public function imp_get()
    {
        $c = $this->db->query("SELECT * FROM tm_impresora")->fetchAll(PDO::FETCH_OBJ);
        return_data_json($c);
    }
    public function update_status($request)
    {
        $filter = $request['filter'];
        $c = $this->db->query("UPDATE tm_impresora SET estado = 
        CASE estado 
        WHEN 'a' THEN 'b'
        WHEN 'b' THEN 'a' END
        WHERE id_impresora  = {$filter}");
        if ($c) {
            response_function('Impresora actualizada', 1);
        } else {
            response_function('Impresora no actualizada', -10);
        }
    }
    public function edit_impresora($request)
    {
        $nombre = $request['nombre_impresora'];
        $corte = $request['corte'];
        $id_imp = $request['id_imp'];

        $c = $this->db->query("UPDATE tm_impresora SET nombre_impresora = '{$nombre}', corte_impresora = '{$corte}' WHERE id_impresora = {$id_imp}");
        if ($c) {
            response_function('Impresora actualizada', 1);
        } else {
            response_function('Impresora no actualizada', -10);
        }
    }
    public function add_impresora($request)
    {
        $nombre = $request['nombre_impresora'];
        $corte = $request['corte'];
        $c = $this->db->query("INSERT INTO tm_impresora (id_impresora, nombre_impresora, corte_impresora, estado) VALUES (null, '{$nombre}', '{$corte}', 'a')");
        if ($c) {
            response_function('Impresora actualizada', 1);
        } else {
            response_function('Impresora no actualizada', -10);
        }
    }
    public function get_imp_reg($id)
    {
        $c = $this->db->query("SELECT * FROM tm_area_impresoras WHERE id_area = '{$id}'")->fetchAll(PDO::FETCH_OBJ);
        foreach ($c as $k => $d) {
            $c[$k]->{'impresora'} = $this->db->query("SELECT * FROM tm_impresora WHERE id_impresora = '{$d->id_impresora}'")->fetch(PDO::FETCH_OBJ);
        }
        return_data_json($c);
    }
    public function elimina_impresora_area($request)
    {
        $id = $request['id'];
        $id_area = $request['area'];
        $c = $this->db->query("DELETE FROM tm_area_impresoras WHERE id_area = '{$id_area}' AND id_impresora = '{$id}'");
        if ($c) {
            response_function('Impresora eliminada de esta area', 1);
        } else {
            response_function('Impresora no eliminada', -10);
        }
    }
    public function get_impresoras_registradas($id)
    {
        $area = $this->db->query("SELECT * FROM tm_area_impresoras WHERE id_area = '{$id}'")->fetchAll(PDO::FETCH_OBJ);
        $c = $this->db->query("");
        foreach ($area as $k => $d) {
            $c[$k] = $this->db->query("SELECT * FROM tm_impresora WHERE id_impresora = '{$d->id_impresora}'")->fetch(PDO::FETCH_OBJ);
        }
        return $c;
    }
    public function impresoras_area(){
        return $this->db->query("SELECT * FROM tm_impresora WHERE estado ='a'")->fetchAll(PDO::FETCH_OBJ);

    }
    public function agrega_impresora($request)
    {
        $id_imp = $request['impresora'];
        $area = $request['area'];
        $c = $this->db->query("SELECT * FROM tm_area_impresoras WHERE id_area = '{$area}' AND id_impresora = '{$id_imp}'")->fetch(PDO::FETCH_OBJ);
        if (!$c) {
            $c = $this->db->query("INSERT INTO tm_area_impresoras (id_area, id_impresora) VALUES ('{$area}', '{$id_imp}')");
            if ($c) {
                response_function('Impresora agregada a esta area', 1);
            } else {
                response_function('Impresora no agregada a esta area', -10);
            }
        } else {
            response_function('Impresora ya registrada, Actualiza la página', -10);
        }
    }
    public function get_docs(){
        $c =  $this->db->query("SELECT * FROM tm_documento")->fetchAll(PDO::FETCH_OBJ);
        return_data_json($c);
    }
    public function get_info_doc($id){
        $c =  $this->db->query("SELECT * FROM tm_documento WHERE id_documento  = {$id}")->fetch(PDO::FETCH_OBJ);
        return_data_json($c);    
    }
    public function save_doc_cfg($data){
        $id_doc = $data['id_doc'];
        $nombre = $data['nombre'];
        $serie = $data['serie'];
        $numero = $data['numero'];
        $estado = $data['estado'];
        if($id_doc != ''){
            $c = $this->db->prepare("UPDATE tm_documento SET nombre = ?, serie = ?, numero = ?, estado = ? WHERE id_documento = ?");
            if ($c->execute(array($nombre, $serie, $numero, $estado, $id_doc))) {
                response_function('El documento se ha actualizado exitosamente', 1);
            } else {
                response_function('Error al actualizar', -10);
            }
        }
    }
}
