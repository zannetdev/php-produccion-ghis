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
$pdf->SetFont('Arial', '', 10);
$helpers->Header(utf8text('REPORTE ' . fechaEs($this->query['ifecha']) . ' a ' . fechaEs($this->query['ffecha']) ),  URL . "public/assets/imprimir/imagenes/logo.jpeg", 'jpeg');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 10);
$helpers->Title('DATOS DE EMPLEADO');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80, 7, utf8text('AREA: ' . $this->empleado->area->nombre), 1, 0, 'R');
$pdf->Cell(200, 7, utf8text('NOMBRE EMPLEADO: ' . $this->empleado->nombre), 1, 1, 'R');
$pdf->Cell(140, 7, utf8text('No. Procesos Tomados: '. count($this->detalle)), 1, 0, 'C');
$total = 0;
foreach($this->detalle as $k => $d){
    $json = $d->{'pedido'}->{'detalle'}->json_tallas;
    $json = json_decode($json);
    foreach ($json as $a => $b){
        $total = $total + $b->cantidad;
    }
}

$pdf->Cell(140, 7, utf8text('No. Pares Producidos: ' . number_format($total / 12, 2) . ' DOCENAS Ó ' . $total . ' UNIDADES') , 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$helpers->Title('PROCESOS');
$pdf->SetFont('Arial', '', 9);
$helpers->table(280, array('# PEDIDO', 'DETALLE (TALLA - UNIDAD)', 'ESTADO', 'FECHA INICIO', 'FECHA FIN'));
$cell_width = 280  / 5;
foreach ($this->detalle as $k => $d){
    $h = 0;
    $x = '';
    $json = json_decode($d->pedido->detalle->json_tallas, false);
    foreach ($json as $j => $z) {
        $x = $x . $z->talla . "/". $z->cantidad . "U \n";
        $h += 5; // CALCULA LA ALTURA DE CADA COLUMN
    }
    $pdf->Cell($cell_width, 5,utf8text('#' . $d->pedido->id_pedido), 1, 0, 'C');
    $pdf->CellFitScale($cell_width, 5,utf8text($x), 1, 0, 'C');
    $estado = $d->fecha_fin == '' ? 'Activo' : 'Finalizado';
    $fecha_fin = $d->fecha_fin == '' ? '-' : $d->fecha_fin;
    $pdf->Cell($cell_width, 5,utf8text($estado), 1, 0, 'C');
    $pdf->Cell($cell_width, 5,utf8text($d->fecha_inicio), 1, 0, 'C');
    $pdf->Cell($cell_width, 5,utf8text($fecha_fin), 1, 1, 'C');
}
$pdf->Output('reporte_empleado_'. str_replace(' ', '', $this->empleado->nombre). time(). '.pdf', 'I');
