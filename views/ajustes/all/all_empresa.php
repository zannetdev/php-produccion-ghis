<div class="row justify-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Datos de la empresa</h4>
                <p class="card-text">Rellene los campos de la empresa de acuerdo se indica.</p>
                <form id="frm_emp" enctype="multipart/form-data" method="POST">
                    <div class="row">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="ruc" name="ruc" placeholder="Ruc Empresa" aria-label="Ruc" aria-describedby="basic-addon2" value="<?php echo $this->empresa->ruc_empresa; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark" type="button" onclick="RQData()"><i class="mdi mdi-card-search-outline"></i></button>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" id="empresa" name="empresa" class="form-control" value="<?php echo $this->empresa->nombre_empresa; ?>" readonly>
                            <small id="helpId" class="text-muted">Nombre Empresa</small>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" id="direccion" name="direccion" class="form-control" value="<?php echo $this->empresa->direccion; ?>" readonly>
                            <small id="helpId" class="text-muted">Dirección</small>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" id="ubigeo" name="ubigeo" class="form-control" value="<?php echo $this->empresa->ubigeo; ?>" readonly>
                            <small id="helpId" class="text-muted">Ubigeo</small>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" id="distrito" name="distrito" class="form-control" value="<?php echo $this->empresa->distrito; ?>" readonly>
                            <small id="helpId" class="text-muted">Distrito</small>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" id="provincia" name="provincia" class="form-control" value="<?php echo $this->empresa->provincia; ?>" readonly>
                            <small id="helpId" class="text-muted">Provincia</small>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" id="departamento" name="departamento" class="form-control" value="<?php echo $this->empresa->departamento; ?>" readonly>
                            <small id="helpId" class="text-muted">Departamento</small>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label for="flag_produc">Modo Producción</label><br>
                            <input id="flag_produc" name="flag_produc" type="checkbox" <?php echo $this->empresa->flag_prod == 'a' ? 'checked' : '' ?> data-toggle="toggle" data-style="slow" value="1">
                        </div>
                        <div class="col-lg-6 mb-2">
                            <label for="flag_sunat">Conectar a SUNAT</label><br>
                            <input id="flag_sunat" name="flag_sunat" type="checkbox" <?php echo $this->empresa->flag_sunat == 'a' ? 'checked' : '' ?> data-toggle="toggle" data-style="slow" value="1">
                        </div>
                        <div class="form-group col-12">
                            <input type="text" id="igv" name="igv" class="form-control" value="<?php echo $this->empresa->igv; ?>" >
                            <small id="helpId" class="text-muted">IGV</small>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" id="usuario_sol" name="usuario_sol" class="form-control" value="<?php echo $this->empresa->usu_sol; ?>" >
                            <small id="helpId" class="text-muted">Usuario SOL</small>
                        </div>
                        <div class="form-group col-6">
                            <input type="text" id="clave_sol" name="clave_sol" class="form-control" value="<?php echo $this->empresa->clave_sol; ?>" >
                            <small id="helpId" class="text-muted">Clave SOL</small>
                        </div>
                        <div class="form-group col-12">
                            <input type="text" id="pwd_certificado" name="pwd_certificado" class="form-control" value="<?php echo $this->empresa->pwd_certificado; ?>" >
                            <small id="helpId" class="text-muted">Contraseña Certificado</small>
                        </div>
                        <label for="">Certificado</label>   
                        <div class="form-control">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="cert_file" id="cert_file">
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-outline-dark col-12" btn-lg btn-block>Guardar Cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="0" id="keyup">
<input type="hidden" value="0" id="validation">