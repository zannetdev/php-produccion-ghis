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


$pdf->Output('tarj_pedido_' . time() . '.pdf', 'I');
