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



$detalle = $this->detalle;
$pdf = new FPDF_CellFiti('P', 'mm', array(280, 280));
// INSTANCIAMOS LA CLASE DE LOS HELPERS
$helpers = new HelpersFPDF($pdf);
$pdf->AddPage();
$pdf->SetMargins(0, 0, 0, 0);
$helpers->Header(utf8text('REPORTE DE APERTURA #' . $detalle->cod_reporte),  URL . "public/assets/imprimir/imagenes/logo.jpeg", 'jpeg');
$helpers->Title('DATOS DE LA APERTURA');
$pdf->SetFont('Arial', 'B', 10);
$cxi = $detalle->fecha_cierre == '' ? 'AUN ESTÁ APERTURADO' : $detalle->fecha_cierre;
$monto_cierre = $detalle->monto_cierre == '' ? '-' : 'S/. '. $detalle->monto_cierre;
if($detalle->monto_cierre != ''){
    $st = $detalle->monto_sistema < $detalle->monto_final ? 'FALTANTE: '  : ' RESTANTE ';
}else{
    $st = '-';
}
$t_ventas = 0.00;
foreach($detalle->ventas->efectivo as $k => $d){
    $t_ventas +=  $d->pago->monto;
} 
foreach($detalle->ventas->t_credito as $k => $d){
    $t_ventas +=  $d->pago->monto;
} 
foreach($detalle->ventas->t_debito as $k => $d){
    $t_ventas +=  $d->pago->monto;
} 
foreach($detalle->ventas->a_credito as $k => $d){
    $t_ventas +=  $d->pago->monto;
} 
$pdf->CellFitScale(140, 7, utf8text( 'FECHA APERTURA: ' . $detalle->fecha_apertura), 1, 0, 'R');
$pdf->CellFitScale(140, 7, utf8text( 'FECHA CIERRE: ' . $cxi ), 1, 1, 'R');
$pdf->CellFitScale(280/3, 7, utf8text( 'MONTO INICIAL:  S/. ' . $detalle->monto_inicial ), 1, 0, 'R');
$pdf->CellFitScale(280/3, 7, utf8text( 'MONTO SISTEMA *(La suma de las ventas)* :  S/. ' . $detalle->monto_sistema ), 1, 0, 'R');
$pdf->CellFitScale(280/3, 7, utf8text( 'MONTO FINAL: ' . $monto_cierre ), 1, 1, 'R');
$pdf->CellFitScale(280/2, 7, utf8text( 'ESTADO DE INGRESOS: ' . $st . number_format($detalle->monto_sistema - $detalle->monto_final, 2) ), 1, 0, 'R');
$pdf->CellFitScale(280/2, 7, utf8text( 'TOTAL VENTAS: ' . number_format($t_ventas, 2) ), 1, 1, 'R');
$pdf->Ln(20);
//-------------------------------------------------------
$helpers->Title('VENTAS EN EFECTIVO');
$helpers->table(280, array('# PEDIDO','MODELO (#)', 'PRECIO (S/.)', 'DETALLE (T/U)', 'TOTAL (S/.)'));
$column = 280 / 5;
$total = 0;
foreach ($detalle->ventas->efectivo as $k => $d) {
    $total += $d->pago->monto;
    $x = "\n";
    $sum = 0;
    $h = 0;
    $json = json_decode($d->detalle_pedido->json_tallas, false);
    foreach ($json as $j => $k) {
        $x = $x . $k->talla . "/". $k->cantidad . "U\n,";
        $h += 5; // CALCULA LA ALTURA DE CADA COLUMN
    }
    $x = trim($x, ',');
    $pdf->Cell($column, $h, utf8text('#' . $d->pago->id_pedido), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->modelo->cod_diseño), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text('S/. ' . $d->modelo->precio), 1, 0, 'C');
    $pdf->CellFitScale($column, $h, utf8text($x), 1, 0, 'J');
    $pdf->Cell($column, $h, utf8text('S/. ' . $d->pago->total), 1,1, 'C');
}
$pdf->Cell(280, 5, utf8text('TOTAL DE EFECTIVO: S/. ' . number_format($total, 2)), 1,1, 'C');
//-------------------------------------------------------
$total = 0;
$pdf->Ln(20);
$helpers->Title('VENTAS EN CREDITO');
$helpers->table(280, array('# PEDIDO','MODELO (#)', 'PRECIO (S/.)', '# TRANSACCION', 'DETALLE (T/U)', 'TOTAL (S/.)'));
$column = 280 / 6;
foreach ($detalle->ventas->t_credito as $k => $d) {
    $total += $d->pago->monto;
    $x = "\n";
    $sum = 0;
    $h = 0;
    $json = json_decode($d->detalle_pedido->json_tallas, false);
    foreach ($json as $j => $k) {
        $x = $x . $k->talla . "/". $k->cantidad . "U \n";
        $h += 5; // CALCULA LA ALTURA DE CADA COLUMN
    }
    $pdf->Cell($column, $h, utf8text('#' . $d->pago->id_pedido), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->modelo->cod_diseño), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text('S/. ' . $d->modelo->precio), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->pago->transaccion_id), 1, 0, 'C');
    $pdf->CellFitScale($column, $h, utf8text($x), 1, 0, 'J');
    $pdf->Cell($column, $h, utf8text('S/. ' . $d->pago->total), 1,1, 'C');
}
$pdf->Cell(280, 5, utf8text('TOTAL DE T.CREDITO: S/. ' . number_format($total, 2)), 1,1, 'C');
$total = 0;
$pdf->Ln(20);
//-------------------------------------------------------

$helpers->Title('VENTAS EN DEBITO');
$helpers->table(280, array('# PEDIDO','MODELO (#)', 'PRECIO (S/.)', '# TRANSACCION', 'DETALLE (T/U)', 'TOTAL (S/.)'));
$column = 280 / 6;
foreach ($detalle->ventas->t_debito as $k => $d) {
    $total += $d->pago->monto;
    $x = "\n";
    $sum = 0;
    $h = 0;
    $json = json_decode($d->detalle_pedido->json_tallas, false);
    foreach ($json as $j => $k) {
        $x = $x . $k->talla . "/". $k->cantidad . "U \n";
        $h += 5; // CALCULA LA ALTURA DE CADA COLUMN
    }
    $pdf->Cell($column, $h, utf8text('#' . $d->pago->id_pedido), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->modelo->cod_diseño), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text('S/. ' . $d->modelo->precio), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->pago->transaccion_id), 1, 0, 'C');
    $pdf->CellFitScale($column, $h, utf8text($x), 1, 0, 'J');
    $pdf->Cell($column, $h, utf8text('S/. ' . $d->pago->total), 1,1, 'C');
}
$pdf->Cell(280, 5, utf8text('TOTAL DE T.DEBITO: S/. ' . number_format($total, 2)), 1,1, 'C');
$total = 0;
$pdf->Ln(20);
//-------------------------------------------------------

$helpers->Title('PEDIDOS DIRECTOS');
$helpers->table(280, array('# PEDIDO','MODELO (#)', 'DETALLE (T/U)'));
$column = 280 / 3;
foreach ($detalle->ventas->s_pago as $k => $d) {
    $h = 0;
    $json = json_decode($d->detalle_pedido->json_tallas, false);
    foreach ($json as $j => $k) {
        $x = $x . $k->talla . "/". $k->cantidad . "U \n";
        $h += 5; // CALCULA LA ALTURA DE CADA COLUMN
    }
    $pdf->Cell($column, $h, utf8text('#' . $d->pago->id_pedido), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->modelo->cod_diseño), 1, 0, 'C');
    $pdf->CellFitScale($column, $h, utf8text($x), 1, 0, 'J');
}
$total = 0;
$pdf->Ln(20);
//-------------------------------------------------------
$helpers->Title('VENTAS A CREDITO');
$helpers->table(280, array('# PEDIDO','MODELO (#)', 'PRECIO (S/.)', 'MONTO PAGADO (S/.)', 'DETALLE (T/U)', 'TOTAL (S/.)'));
$column = 280 / 6;
foreach ($detalle->ventas->a_credito as $k => $d) {
    $total += $d->pago->monto;
    $x = "\n";
    $sum = 0;
    $h = 0;
    $json = json_decode($d->detalle_pedido->json_tallas, false);
    foreach ($json as $j => $k) {
        $x = $x . $k->talla . "/". $k->cantidad . "U \n";
        $h += 5; // CALCULA LA ALTURA DE CADA COLUMN
    }
    $pdf->Cell($column, $h, utf8text('#' . $d->pago->id_pedido), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->modelo->cod_diseño), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text('S/. ' . $d->modelo->precio), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->pago->monto), 1, 0, 'C');
    $pdf->Cell($column, $h, utf8text($d->pago->transaccion_id), 1, 0, 'C');
    $pdf->CellFitScale($column, $h, utf8text($x), 1, 0, 'J');
    $pdf->Cell($column, $h, utf8text('S/. ' . $d->pago->total), 1,1, 'C');
}
$pdf->Cell(280, 5, utf8text('TOTAL DE CREDITOS: S/. ' . number_format($total, 2)), 1,1, 'C');
$total = 0;
$pdf->Ln(20);

$pdf->Output('apertura_' . time() . '.pdf', 'I');
