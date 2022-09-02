<?php
declare(strict_types=1);

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Company;
use Greenter\Model\Company\Address;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\FormaPagos\FormaPagoCredito;

use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\SaleDetail;
use Greenter\Model\Sale\Legend;
$_SESSION['empresa']->flag_sunat == 'b' ? header('Location: ' . URL) : '';
function dc_($n)
{
    return number_format((float)($n), 2, '.', ',');
}

class Fact extends Controller
{
    public $empresa = null;
    public $seeObject = null;
    public function __construct()
    {
        parent::__construct();
        $this->seeObject = require 'server/sunat/config.php';
        $this->empresa  = Session::get('empresa');
    }
    public function index()
    {
        $this->view->docs = $this->model->get_docs();
        $this->view->js = array('sunat/js/all_fact.js');
        $this->view->render('sunat/all');
    }
    public function facturaAll()
    {
        isset($_POST) ? '' : exit('No existe');
        $cr = $this->model->crrl();
        $detalle = $this->model->get_pedido($_POST['id_pago']);
        $detalle ? '' : exit('error');
        try {
            // data
            $total_ope_gravadas = 0.00;
            $igv_total = 0.00;
            $subtotal = 0.00;
            $igv = 0.00;
            $total = 0.00;
            $perc_igv = 0.00;
            $prodc_precio = 0.00;
            $prodc_precio_igv = 0.00;
            $cantidad = 0;
            $total_ope_gravadas =  (float) $total_ope_gravadas +  $detalle->pago->subtotal;
            $igv_total = (float) +$detalle->pago->igv;
            $subtotal =  (float) $detalle->pago->subtotal;
            $total = (float)$detalle->pago->total;
            $perc_igv = (float)$this->empresa->igv / 100;
            $prodc_precio = (float) $detalle->producto->precio;
            $prodc_precio_igv = (float) $prodc_precio + ($prodc_precio * $perc_igv);
            $cantidad = (int) $subtotal / $prodc_precio;

            $igv = (float) $this->empresa->igv;
            //

            // Cliente
            $client = new Client();
            $client->setTipoDoc('6')
            ->setNumDoc($detalle->cliente->num_doc)
            ->setRznSocial($detalle->cliente->nombre . ' ' . $detalle->cliente->apellido_paterno . ' ' . $detalle->cliente->apellido_materno);

            // Emisor
            $address = new Address();
            $address->setUbigueo($this->empresa->ubigeo)
                ->setDepartamento($this->empresa->departamento)
                ->setProvincia($this->empresa->provincia)
                ->setDistrito($this->empresa->distrito)
                ->setUrbanizacion('-')
                ->setDireccion($this->empresa->direccion)
                ->setCodLocal('0000'); // Codigo de establecimiento asignado por SUNAT, 0000 de lo contrario.

            $company = new Company();
            $company->setRuc($this->empresa->ruc_empresa)
                ->setRazonSocial($this->empresa->nombre_empresa)
                ->setNombreComercial($this->empresa->nombre_empresa)
                ->setAddress($address);

            // Venta
            $invoice = (new Invoice())
                ->setUblVersion('2.1')
                ->setTipoOperacion('0101') // Venta - Catalog. 51
                ->setTipoDoc('01') // Factura - Catalog. 01
                ->setSerie('F001')
                ->setCorrelativo($cr)
                ->setFechaEmision(new DateTime())
                ->setFormaPago(new FormaPagoContado())
                ->setTipoMoneda('PEN') // Sol - Catalog. 02
                ->setCompany($company)
                ->setClient($client)
                ->setMtoOperGravadas($total_ope_gravadas)
                ->setMtoIGV($igv_total)
                ->setTotalImpuestos($igv_total)
                ->setValorVenta($subtotal)
                ->setSubTotal($total)
                ->setMtoImpVenta($total);

            $item = (new SaleDetail())
                ->setCodProducto('P001')
                ->setUnidad('NIU') // Unidad - Catalog. 03
                ->setCantidad($cantidad)
                ->setDescripcion('VENTA DE ' . $cantidad . ' PAQUETES DE CALZADO CON CODIGO DE MODELO: ' . $detalle->producto->cod_diseño)
                ->setMtoBaseIgv($subtotal)
                ->setPorcentajeIgv($igv) // 18%
                ->setIgv($igv_total)
                ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
                ->setTotalImpuestos($igv_total)
                ->setMtoValorVenta($subtotal)
                ->setMtoValorUnitario($prodc_precio)
                ->setMtoPrecioUnitario($prodc_precio_igv);

            $legend = (new Legend())
                ->setCode('1000') // Monto en letras - Catalog. 52
                ->setValue(convertir($detalle->pago->total));

            $invoice->setDetails([$item])
                ->setLegends([$legend]);

            // Envío a SUNAT
            $result = $this->seeObject->send($invoice);

            // Guardar XML firmado digitalmente.
            file_put_contents(
                'sunat/res/xml/' . $invoice->getName() . '.xml',
                $this->seeObject->getFactory()->getLastXml()
            );

            // Verificamos que la conexión con SUNAT fue exitosa.
            if (!$result->isSuccess()) {
                // Mostrar error al conectarse a SUNAT.
                echo 'Codigo Error: ' . $result->getError()->getCode();
                echo 'Mensaje Error: ' . $result->getError()->getMessage();
                exit();
            }
            // Guardamos el CDR
            file_put_contents('sunat/res/cdr/R-' . $invoice->getName() . '.zip', $result->getCdrZip());
            // CDR Resultado
            $cdr = $result->getCdrResponse();

            $code = (int)$cdr->getCode();
            if ($code === 0) {
                $this->model->new_correlativo();
                $this->model->change_status($_POST['id_pago']);
                $this->model->new_billing_queue(
                    array(
                        "id_pago" => $_POST['id_pago'],
                        "cdr_route" => URL . 'sunat/res/cdr/R-' . $invoice->getName() . '.zip',
                        "xml_response" => URL . 'sunat/res/xml/' . $invoice->getName() . '.xml',
                        "status_sunat" => $code,
                        "type_fact" => 2
                    )
                );
            } else if ($code >= 4000) {
                $this->model->new_correlativo();
                $this->model->change_status($_POST['id_pago']);
                $this->model->new_billing_queue(
                    array(
                        "id_pago" => $_POST['id_pago'],
                        "cdr_route" => URL . 'sunat/res/cdr/R-' . $invoice->getName() . '.zip',
                        "xml_response" => URL . 'sunat/res/xml/' . $invoice->getName() . '.xml',
                        "status_sunat" => $code,
                        "type_fact" => 2
                    )
                );
            } else if ($code >= 2000 && $code <= 3999) {
                response_function('Factura Rechazada', -10);
            } else {
                /* Esto no debería darse */
                /*code: 0100 a 1999 */
                echo 'Excepción';
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function boletaAll()
    {
        isset($_POST) ? '' : exit('No existe');
        $cr = $this->model->crrl();
        $detalle = $this->model->get_pedido($_POST['id_pago']);
        $detalle ? '' : exit('error');
        try {
            // data
            $total_ope_gravadas = 0.00;
            $igv_total = 0.00;
            $subtotal = 0.00;
            $igv = 0.00;
            $total = 0.00;
            $perc_igv = 0.00;
            $prodc_precio = 0.00;
            $prodc_precio_igv = 0.00;
            $cantidad = 0;
            $total_ope_gravadas =  (float) $total_ope_gravadas +  $detalle->pago->subtotal;
            $igv_total = (float) +$detalle->pago->igv;
            $subtotal =  (float) $detalle->pago->subtotal;
            $total = (float)$detalle->pago->total;
            $perc_igv = (float)$this->empresa->igv / 100;
            $prodc_precio = (float) $detalle->producto->precio;
            $prodc_precio_igv = (float) $prodc_precio + ($prodc_precio * $perc_igv);
            $cantidad = (int) $subtotal / $prodc_precio;

            $igv = (float) $this->empresa->igv;
            //

            // Cliente
            $client = new Client();
            $client->setTipoDoc('1')
                ->setNumDoc($detalle->cliente->num_doc)
                ->setRznSocial($detalle->cliente->nombre . ' ' . $detalle->cliente->apellido_paterno . ' ' . $detalle->cliente->apellido_materno);

            // Emisor
            $address = new Address();
            $address->setUbigueo($this->empresa->ubigeo)
                ->setDepartamento($this->empresa->departamento)
                ->setProvincia($this->empresa->provincia)
                ->setDistrito($this->empresa->distrito)
                ->setUrbanizacion('-')
                ->setDireccion($this->empresa->direccion)
                ->setCodLocal('0000'); // Codigo de establecimiento asignado por SUNAT, 0000 de lo contrario.

            $company = new Company();
            $company->setRuc($this->empresa->ruc_empresa)
                ->setRazonSocial($this->empresa->nombre_empresa)
                ->setNombreComercial($this->empresa->nombre_empresa)
                ->setAddress($address);

            // Venta
            $invoice = (new Invoice())
                ->setUblVersion('2.1')
                ->setTipoOperacion('0101') // Venta - Catalog. 51
                ->setTipoDoc('01') // Factura - Catalog. 01
                ->setSerie('B001')
                ->setCorrelativo($cr)
                ->setFechaEmision(new DateTime())
                ->setTipoMoneda('PEN') // Sol - Catalog. 02
                ->setCompany($company)
                ->setClient($client)
                ->setMtoOperGravadas($total_ope_gravadas)
                ->setMtoIGV($igv_total)
                ->setTotalImpuestos($igv_total)
                ->setValorVenta($subtotal)
                ->setSubTotal($total)
                ->setMtoImpVenta($total);

            $item = (new SaleDetail())
                ->setCodProducto('P001')
                ->setUnidad('NIU') // Unidad - Catalog. 03
                ->setCantidad($cantidad)
                ->setDescripcion('VENTA DE ' . $cantidad . ' PAQUETES DE CALZADO CON CODIGO DE MODELO: ' . $detalle->producto->cod_diseño)
                ->setMtoBaseIgv($subtotal)
                ->setPorcentajeIgv($igv) // 18%
                ->setIgv($igv_total)
                ->setTipAfeIgv('10') // Gravado Op. Onerosa - Catalog. 07
                ->setTotalImpuestos($igv_total)
                ->setMtoValorVenta($subtotal)
                ->setMtoValorUnitario($prodc_precio)
                ->setMtoPrecioUnitario($prodc_precio_igv);

            $legend = (new Legend())
                ->setCode('1000') // Monto en letras - Catalog. 52
                ->setValue(convertir($detalle->pago->total));

            $invoice->setDetails([$item])
                ->setLegends([$legend]);
            $xml = $this->seeObject->getXmlSigned($invoice);
            // Guardar XML
            $filename = 'sunat/res/xml/' . $invoice->getName() . '.xml';
            file_put_contents($filename, $xml);

            $this->model->new_correlativo();
            $this->model->change_status($_POST['id_pago']);
            $this->model->new_billing_queue(
                array(
                    "id_pago" => $_POST['id_pago'],
                    "cdr_route" => null,
                    "xml_response" => URL . 'sunat/res/xml/' . $invoice->getName() . '.xml',
                    "status_sunat" => 0,
                    "type_fact" => 1
                )
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function get_ven()
    {
        $this->model->get_ven();
    }
    public function get_sunat()
    {
        $this->model->get_sunat();
    }
}
