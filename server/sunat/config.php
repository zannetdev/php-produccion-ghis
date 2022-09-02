<?php
// return the $seeObject

use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Greenter\XMLSecLibs\Certificate\X509Certificate;
use Greenter\XMLSecLibs\Certificate\X509ContentType;

$empresa = Session::get('empresa');
if ($empresa->flag_sunat == 'a') {
    $pfx = file_get_contents(   $empresa->ruta_certificado);
    $password = $empresa->pwd_certificado;
    $certificate = new X509Certificate($pfx, $password);
    $see = new See();
    $see->setService($empresa->flag_prod === 'a' ? SunatEndpoints::FE_PRODUCCION : SunatEndpoints::FE_BETA);
    $see->setCertificate($certificate->export(X509ContentType::PEM));
    $see->setClaveSOL($empresa->ruc_empresa, $empresa->usu_sol, $empresa->clave_sol);
    return $see;
}else{
    return false;
}
