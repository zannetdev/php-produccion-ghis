<?php
ob_start();
require_once('pdf/pdf/cellfit.php');
class FPDF_CellFiti extends FPDF_CellFit
{
    function AutoPrint($dialog = false)
    {
        //Open the print dialog or start printing immediately on the standard printer
        $param = ($dialog ? 'true' : 'false');
        $script = "print($param);";
        $this->IncludeJS($script);
    }

    function AutoPrintToPrinter($server, $printer, $dialog = false)
    {
        //Print on a shared printer (requires at least Acrobat 6)
        $script = "var pp = getPrintParams();";
        if ($dialog)
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
        else
            $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
        $script .= "pp.printerName = '\\\\\\\\" . $server . "\\\\" . $printer . "';";
        $script .= "print(pp);";
        $this->IncludeJS($script);
    }
}



// VARIABLES HEREDADAS DE LA VISTA A LOCALES PARA MÁS LEGIBILIDAD.
$empresa = $this->empresa;
$detalle = $this->detalle;
$pdf = new FPDF_CellFiti('P', 'mm', array(80, 500));
// INSTANCIAMOS LA CLASE DE LOS HELPERS
$helpers = new HelpersFPDF($pdf);
$pdf->AddPage();
$pdf->SetMargins(0, 0, 0, 0);
$hr = date_create($detalle->fecha);
$hrx = date_format($hr, "h:i:s A");
$url_logo = URL . "public/assets/imprimir/imagenes/logo.jpeg";
$pdf->Image($url_logo, L_CENTER, 2, L_DIMENSION, 0, 'jpeg');
$pdf->Cell(72, L_ESPACIO, '', 0, 1, 'C');
$pdf->SetFont('ticket', '', 10);
$pdf->SetY(L_DIMENSION - (L_DIMENSION / 3));
$cabecera_empresa = $empresa->nombre . "\n" . "Dirección: " .
    $empresa->direccion . "\nUbigeo: " . $empresa->ubigeo . "\n" . $empresa->provincia . ',' . $empresa->departamento . ', Peru.' . "\nTeléfono:" . TELEFONO_EMPRESA;
$pdf->MultiCell(80, 5, utf8text($cabecera_empresa), 0, 'C');
$pdf->Ln(5);
$helpers->outline_line();
$pdf->SetFont('ticket', '', 16);
$pdf->Ln(5);
$pdf->Cell(80, 5, utf8text('PEDIDO NO #' . $detalle->id_pedido), 0, 1, 'C');
$pdf->SetFont('ticket', '', 10);
$pdf->Ln(5);
$pdf->Cell(80, 5, utf8text('FECHA DE COMPRA: ' . fechaEs($detalle->fecha)), 0, 1, 'R');
$pdf->Cell(80, 5, utf8text('HORA DE COMPRA: ' . $hrx), 0, 1, 'R');
$pdf->Cell(80, 5, utf8text('CLIENTE: ' .  $detalle->cliente->nombre), 0, 1, 'R');
$estado = '';
switch ($detalle->estado) {
    case 'r':
        $estado = 'CANCELADO POR ERROR CON EL PAGO';
        break;
    case 'p':
        $estado = 'EN PRODUCIÓN';
        break;
    case 'pc':
        $estado = 'EN ESPERA DE CONFIRMACIÓN';
        break;
    case 't':
        $estado = 'TERMINADO';
        break;
    case 'c':
        $estado = 'EN COLA';
        break;
    default:
        $estado = $detalle->estado;
        break;
}
$pago = '';
switch ($detalle->pago->metodo_pago) {
    case 1:
        $pago = 'EFECTIVO';
        break;
    case 2:
        $pago = 'TARJETA DE CREDITO';
        break;
    case 3:
        $pago = 'TARJETA DE DEBITO';
        break;
    case 4:
        $pago = 'PEDIDO DIRECTO';
        break;
    case 5:
        $pago = 'A CREDITO';
        break;
    default:
        $pago = '';
        break;
}
$pdf->Cell(80, 5, utf8text('ESTADO DEL PEDIDO: ' . $estado), 0, 1, 'R');
$pdf->Cell(80, 5, utf8text('TOTAL COMPRA: ' . 'S/. ' . number_format($detalle->pago->total, 2)), 0, 1, 'R');
$pdf->Cell(80, 5, utf8text('MONTO RECIBIDO ACTUAL: ' . 'S/. ' . number_format($detalle->pago->monto, 2)), 0, 1, 'R');


$pdf->Cell(80, 5, utf8text('TIPO DE PAGO: '  . $pago), 0, 1, 'R');
$pdf->Cell(80, 5, utf8text('COD PAGO: '  . $detalle->pago->transaccion_id), 0, 1, 'R');
$pdf->Ln(5);
$helpers->outline_line();
$pdf->Ln(5);
$pdf->SetFont('ticket', '', 16);
$pdf->Cell(80, 5, utf8text('MODELO NO #' . $detalle->modelo->cod_diseño), 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('ticket', '', 10);
$obs = $detalle->detalle_pedido->observacion == '' ? 'N/A' : $detalle->detalle_pedido->observacion;
$pdf->Cell(80, 5, utf8text('PRECIO: ' . 'S/. ' . number_format($detalle->modelo->precio, 2)), 0, 1, 'R');
$pdf->Cell(80, 5, utf8text('COLOR: ' . $detalle->detalle_pedido->color), 0, 1, 'R');
$pdf->Cell(80, 5, utf8text('OBSERVACIONES: ' . $obs), 0, 1, 'R');
$pdf->Ln(2);
$helpers->table(80, array('TALLA', 'CANTIDAD'));
$json_tallas = json_decode($detalle->detalle_pedido->json_tallas, false);
$sum = 0;
foreach ($json_tallas as $k => $d) {

    $pdf->Cell(40, 5, utf8text($d->talla), 1, 0, 'C');
    $pdf->Cell(40, 5, utf8text($d->cantidad), 1, 1, 'C');
    $sum += $d->cantidad;
}
$pdf->Ln(2);
$helpers->outline_line();
$pdf->Cell(80, 5, utf8text('TOTAL: ' . $sum . ' UNTS'), 0, 1, 'R');
$helpers->outline_line();
$pdf->Cell(80, 5, utf8text('DECENAS TOTALES: ' . number_format($sum / 12, 2) . ' DEC'), 0, 1, 'R');
$helpers->outline_line();

if ($detalle->pago->metodo_pago  == 5) {
    $pdf->Ln(5);
    $pdf->SetFont('ticket', '', 16);
    $pdf->Cell(80, 5, utf8text('HISTORIAL DE CRÉDITO'), 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('ticket', '', 10);
    $hinicio = date_create($detalle->credito->fecha_inicio);

    $hinicio = date_format($hinicio, "h:i:s A");
    if ($detalle->credito->fecha_fin != '') {
        $hrfin = date_create($detalle->credito->fecha_fin);
        $hrfin = date_format($hrfin, "h:i:s A");
        $fin = fechaEs($detalle->credito->fecha_fin) . ' A LAS ' . $hrfin;
    } else {
        $fin = '-';
    }


    $pdf->MultiCell(80, 5, utf8text('FECHA DE INICIO: ' . fechaEs($detalle->credito->fecha_inicio) . ' A LAS ' . $hinicio), 0, 'R');

    $pdf->MultiCell(80, 5, utf8text('FECHA DE FIN: ' . $fin), 0, 'R');
    $pdf->Cell(80, 5, utf8text('CLIENTE: ' .  $detalle->cliente->nombre), 0, 1, 'R');
    $pdf->Ln(2);
    $pdf->SetFont('ticket', '', 16);
    $pdf->Cell(80, 5, utf8text('HISTORIAL DE PAGOS'), 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('ticket', '', 10);
    $helpers->table(80, array('MONTO', 'FECHA', 'SALDO'));
    if (count($detalle->credito->historial) > 0) {
        $w = 80 / 3;
        $t = $detalle->pago->total;
        $saldo = $t;
        foreach ($detalle->credito->historial as $k => $d) {
            $saldo -= $d->monto;
            $f = date_create($d->fecha);
            $f = date_format($f, "Y/m/d");
            $pdf->Cell($w, 5, utf8text('S/. ' . $d->monto), 1, 0, 'C');
            $pdf->Cell($w, 5, utf8text($f), 1, 0, 'C');
            $pdf->Cell($w, 5, utf8text('S/. ' . number_format($saldo, 2)), 1, 1, 'C');
            $sum += $d->cantidad;
        }
        if ($detalle->pago->monto == $detalle->pago->total || $detalle->pago->monto > $detalle->pago->total) {
            $pdf->MultiCell(80, 5, utf8text('SALDO: S/. 0.00'), 0, 'R');
        }else{
            $pdf->MultiCell(80, 5, utf8text('DEBES: S/. ' . $saldo), 0, 'R');
        }
    } else {
        $pdf->SetFont('ticket', '', 16);
        $pdf->Cell(80, 5, utf8text('SIN HISTORIAL'), 0, 1, 'C');
        $pdf->SetFont('ticket', '', 10);
    }
}
$pdf->Ln(2);
$helpers->signature($detalle->cliente->nombre, 80, 'ESTE DOCUMENTO SIRVE PARA DARLE VALIDÉZ AL PEDIDO Y PARA ACLARACIONES.');
$pdf->Ln(2);
$qr = URL . "qr.png";

$pdf->Image($qr, L_CENTER, null, L_DIMENSION, 0, 'png', URL);
// dimension de 
// CABECERA
$pdf->Output('ticket_pedido_' . time() . '.pdf', 'I');
