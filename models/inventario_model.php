<?php
class Inventario_Model extends Model
{

	public function __construct()
	{
		parent::__construct();
	}
	public function catg_modelos()
	{
		$c = $this->db->query("SELECT * FROM tm_categoria")->fetchAll(PDO::FETCH_OBJ);
		return_data_json($c);
	}
	public function get_modelos($request)
	{
		$filter = $request['catg_id'];
		$c = $this->db->query("SELECT * FROM tm_modelo WHERE id_categoria LIKE '{$filter}'")->fetchAll(PDO::FETCH_OBJ);
		return_data_json($c);
	}
	public function get_inventario($request)
	{
		$filter = $request['catg_id'];
		$c = $this->db->query("SELECT * FROM tm_insumo WHERE id_categoria LIKE '{$filter}'")->fetchAll(PDO::FETCH_OBJ);
		return_data_json($c);
	}
	public function get_inventario_catg()
	{
		$c = $this->db->query("SELECT * FROM tm_inventario_catg")->fetchAll(PDO::FETCH_OBJ);
		return_data_json($c);
	}
	// 
	public function get_catg_inventario()
	{
		return $this->db->query("SELECT * FROM tm_inventario_catg")->fetchAll(PDO::FETCH_OBJ);
	}
	public function insert_ins($request)
	{
		$nombre = $request['nombre'];
		$id_categoria = $request['id_categoria'];
		$estado = $request['estado'];
		$date = date('Y-m-d H:i:s');
		$c = $this->db->prepare("INSERT INTO tm_insumo (id_insumo, id_categoria, nombre, fecha_agregado, estado) VALUES(null, ?, ?, ?, ?)");
		$stm = $c->execute(array($id_categoria, $nombre, $date, $estado));
		if ($stm) {
			response_function('Material para producción agregado', 1);
		} else {
			response_function('No se pudo insertar el material', -10);
		}
	}
	public function edita_ins($request)
	{
		$nombre = $request['nombre'];
		$id_categoria = $request['id_categoria'];
		$estado = $request['estado'];
		$id_insumo  = $request['id_insumo'];
		$c = $this->db->query("UPDATE tm_insumo SET id_categoria = {$id_categoria}, nombre = '{$nombre}', estado = '{$estado}' WHERE id_insumo = {$id_insumo}");
		if ($c) {
			response_function('Material para producción actualizado', 1);
		} else {
			response_function('No se pudo actualizar el material', -10);
		}
	}
	public function get_catg_modelos()
	{
		return $this->db->query("SELECT * FROM tm_categoria")->fetchAll(PDO::FETCH_OBJ);
	}
	public function insert_catg_modelo($request)
	{
		$nombre = $request['nombre'];
		$estado = $request['estado'];
		$c = $this->db->prepare("INSERT INTO tm_categoria (id_categoria, nombre, estado) VALUES(null, ?, ?)");
		$response = $c->execute(array($nombre, $estado));
		if ($response) {
			response_function('Categoria agregada', 1);
		} else {
			response_function('No se pudo insertar la agregada', -10);
		}
	}
	public function edita_catg_model($request)
	{
		$nombre = $request['nombre'];
		$estado = $request['estado'];
		$id_categoria = $request['id_categoria'];
		$c = $this->db->query("UPDATE tm_categoria SET nombre  = '{$nombre}', estado = '{$estado}' WHERE id_categoria = {$id_categoria}");
		if ($c) {
			response_function('Categoria actualizada', 1);
		} else {
			response_function('No se pudo actualizar la categoria', -10);
		}
	}

	public function get_specific_model($id)
	{
		return $this->db->query("SELECT * FROM tm_modelo WHERE id_modelo = {$id}")->fetch(PDO::FETCH_OBJ);
	}
	public function inventario()
	{
		return $this->db->query("SELECT * FROM v_inventario WHERE estado = 'a'")->fetchAll(PDO::FETCH_OBJ);
	}
	public function agrega_modelo($request)
	{
		$cuero_1 = $request['cuero_1'];
		$cuero_2 = $request['cuero_2'];
		$capellado = $request['capellado'];
		$tela = $request['tela'];
		$forro_1 = $request['forro_1'];
		$forro_2 = $request['forro_2'];
		$desuaste_1 = $request['desuaste_1'];
		$desuaste_2 = $request['desuaste_2'];
		$pin_bordes = $request['pin_bordes'];
		$aguja_1 = $request['aguja_1'];
		$aguja_2 = $request['aguja_2'];
		$hilo_1 = $request['hilo_1'];
		$hilo_2 = $request['hilo_2'];
		$hilo_drama = $request['hilo_drama'];
		$esponja = $request['esponja'];
		$chapita = $request['chapita'];
		$cod_diseno = $request['cod_diseno'];
		$total_consumo_cuero = $request['total_consumo_cuero'];
		$precio = floatval($request['precio']);
		$marcos = "";
		if (count($request['marco']['otros'])) {
			if ($request['marco']['lateral'] != 'no') {
				$marcos .= 'Lateral,';
			}
			if ($request['marco']['lengua'] != 'no') {
				$marcos .= 'Lengua,';
			}
			for ($x = 0; $x < count($request['marco']['otros']); $x++) {
				$marcos .= ucfirst($request['marco']['otros'][$x]) . ',';
			}
		} else {
			if ($request['marco']['lateral'] != 'no') {
				$marcos .= 'Lateral,';
			}
			if ($request['marco']['lengua'] != 'no') {
				$marcos .= 'Lengua,';
			}
		}
		$id_tmp = $request['id_temporal'];
		$marcos = trim($marcos, ',');
		$consumo_cierre_docena = $request['consumo_cierre_docena'];
		$img = $this->db->query("SELECT route FROM tm_tmp_images WHERE id_tmp = '{$id_tmp}'")->fetch(PDO::FETCH_OBJ);
		$no_patron = $request['no_patron'];
		$horma = $request['horma'];
		$planta = $request['planta'];
		$falso = $request['falso'];
		$plantillo = $request['plantillo'];
		$latex = $request['latex'];
		$preimer = $request['preimer'];
		$sombreado = $request['sombreado'];
		$taco = $request['taco'];
		$serie = $request['serie'];
		$id_categoria = $request['id_categoria'];
		$estado  =  'a';
		$grabado = $request['grabado'];
		$marcar_empalme = $request['marcar_empalme'];
		$fecha = date('Y-m-d H:i:s');
		$existencia = $this->db->query("SELECT id_modelo FROM tm_modelo WHERE cod_diseño = '{$cod_diseno}'")->fetchAll(PDO::FETCH_OBJ);
		if (!$existencia) {
			$c = $this->db->query("INSERT INTO tm_modelo
			(id_modelo, id_categoria, cod_diseño, precio, 
			cuero_1, cuero_2, capellado, tela, forro_1, 
			forro_2, grabado, marcar_empalme, desuaste_1, 
			desuaste_2, pintado_bordes, aguja_1, aguja_2, hilo_1, 
			hilo_2, hilo_drama, esponja, chapita, sellar_marca, 
			consumo_cierre_por_doc, consumo_cuero_por_doc, 
			n_patron, horma, planta, falso, plantillos,
			latex, preimer, sombreado, taco, 
			serie, imagen, fecha, estado)
			VALUES(null, {$id_categoria}, '{$cod_diseno}', 
			'{$precio}', '{$cuero_1}','{$cuero_2}', 
			'{$capellado}', '{$tela}', '{$forro_1}',
			'{$forro_2}','{$grabado}','{$marcar_empalme}','{$desuaste_1}',
			'{$desuaste_2}','{$pin_bordes}', '{$aguja_1}','{$aguja_2}','{$hilo_1}',
			'{$hilo_2}', '{$hilo_drama}','{$esponja}', '{$chapita}','{$marcos}',
			'{$consumo_cierre_docena}','{$total_consumo_cuero}','{$no_patron}',
			'{$horma}','{$planta}','{$falso}','{$plantillo}','{$latex}','{$preimer}',
			'{$sombreado}','{$taco}','{$serie}','{$img->route}', '{$fecha}','{$estado}')");
			if ($c) {
				response_function('Modelo registrado correctamente', 1);
			} else {
				response_function('Modelo no registrado correctamente', -10);
			}
		} else {
			response_function('Codigo de diseño ya registrado, usa otro.', -10);
		}
	}
	public function edita_modelo($request, $id)
	{
		$cod_anterior = $this->db->query("SELECT cod_diseño FROM tm_modelo WHERE id_modelo = {$id}")->fetch(PDO::FETCH_OBJ);

		$cuero_1 = $request['cuero_1'];
		$cuero_2 = $request['cuero_2'];
		$capellado = $request['capellado'];
		$tela = $request['tela'];
		$forro_1 = $request['forro_1'];
		$forro_2 = $request['forro_2'];
		$desuaste_1 = $request['desuaste_1'];
		$desuaste_2 = $request['desuaste_2'];
		$pin_bordes = $request['pin_bordes'];
		$aguja_1 = $request['aguja_1'];
		$aguja_2 = $request['aguja_2'];
		$hilo_1 = $request['hilo_1'];
		$hilo_2 = $request['hilo_2'];
		$hilo_drama = $request['hilo_drama'];
		$esponja = $request['esponja'];
		$chapita = $request['chapita'];
		$cod_diseno = $request['cod_diseno'];
		$total_consumo_cuero = $request['total_consumo_cuero'];
		$precio = floatval($request['precio']);
		$marcos = "";
		if (count($request['marco']['otros'])) {
			if ($request['marco']['lateral'] != 'no') {
				$marcos .= 'Lateral,';
			}
			if ($request['marco']['lengua'] != 'no') {
				$marcos .= 'Lengua,';
			}
			for ($x = 0; $x < count($request['marco']['otros']); $x++) {
				$marcos .= ucfirst($request['marco']['otros'][$x]) . ',';
			}
		} else {
			if ($request['marco']['lateral'] != 'no') {
				$marcos .= 'Lateral,';
			}
			if ($request['marco']['lengua'] != 'no') {
				$marcos .= 'Lengua,';
			}
		}
		$id_tmp = $request['id_temporal'];
		$marcos = trim($marcos, ',');
		$consumo_cierre_docena = $request['consumo_cierre_docena'];
		$img = $this->db->query("SELECT route FROM tm_tmp_images WHERE id_tmp = '{$id_tmp}'")->fetch(PDO::FETCH_OBJ);
		$no_patron = $request['no_patron'];
		$horma = $request['horma'];
		$planta = $request['planta'];
		$falso = $request['falso'];
		$plantillo = $request['plantillo'];
		$latex = $request['latex'];
		$preimer = $request['preimer'];
		$sombreado = $request['sombreado'];
		$taco = $request['taco'];
		$serie = $request['serie'];
		$id_categoria = $request['id_categoria'];
		$estado  =  'a';
		$grabado = $request['grabado'];
		$marcar_empalme = $request['marcar_empalme'];
		$fecha = date('Y-m-d H:i:s');
		$existencia = $this->db->query("SELECT id_modelo FROM tm_modelo WHERE cod_diseño = '{$cod_diseno}' AND cod_diseño <> '{$cod_anterior->cod_diseño}'")->fetchAll(PDO::FETCH_OBJ);
		if (!$existencia) {
			$c = $this->db->query("UPDATE tm_modelo SET id_categoria = '{$id_categoria}', cod_diseño = '{$cod_diseno}',
			precio = '{$precio}', cuero_1 = '{$cuero_1}', cuero_2 = '{$cuero_2}', capellado = '{$capellado}', tela = '{$tela}',
			forro_1 = '{$forro_1}', forro_2 = '{$forro_2}', grabado = '{$grabado}', marcar_empalme = '{$marcar_empalme}', desuaste_1 = '{$desuaste_1}',
			desuaste_2 = '{$desuaste_2}', pintado_bordes = '{$pin_bordes}', aguja_1 = '{$aguja_1}', aguja_2 = '{$aguja_2}', hilo_1 = '{$hilo_1}',
			hilo_2 = '{$hilo_2}', hilo_drama = '{$hilo_drama}', esponja = '{$esponja}', chapita = '{$chapita}', sellar_marca = '{$marcos}',
			consumo_cierre_por_doc = '{$consumo_cierre_docena}', consumo_cuero_por_doc = '{$total_consumo_cuero}', n_patron = '{$no_patron}',
			horma = '{$horma}', planta = '{$planta}', falso = '{$falso}', plantillos = '{$plantillo}', latex = '{$latex}', preimer = '{$preimer}',
			sombreado = '{$sombreado}', taco = '{$taco}', serie = '{$serie}', imagen = '{$img->route}', fecha = '{$fecha}', estado = '{$estado}' 
			WHERE id_modelo = {$id}");
			if ($c) {
				response_function('Modelo actualizado correctamente', 1);
			} else {
				response_function('Modelo no actualizado correctamente', -10);
			}
		} else {
			response_function('Codigo de diseño ya registrado, usa otro.', -10);
		}
	}
	public function delete($id = null)
	{
		$id == null ? exit('ERROR') : '';
		$c = $this->db->prepare("DELETE FROM tm_insumo WHERE id_insumo = ?");
		if ($c->execute([$id])) {
			response_function('Eliminado correctamente', 1);
		} else {
			response_function('Error', -10);
		}
	}
}
