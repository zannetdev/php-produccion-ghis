<?php

class HelpersFPDF
{
    public $fpdf;
    public function __construct($fpdf)
    {
        $this->fpdf = $fpdf;
    }
    public function outline_line()
    {
        $this->fpdf->Cell(80, 0, '- - - - - - - - - - - - - - - - - - - - - - - - -', 0, 1, 'C');
    }
    public function table($width_page, $columns = [])
    {
        if (is_array($columns)) {
            $with_column = $width_page / count($columns);
            for ($x = 0; $x < count($columns) + 1; $x++) {
                $this->fpdf->Cell($with_column, 5, utf8text($columns[$x]), 1, 0, 'C');
            }
            $this->fpdf->Cell($width_page, 5, '', 0, 1, 'C');
        }
    }
    public function signature($name, $width_page, $help_text)
    {
        $this->fpdf->Ln(10);
        $this->fpdf->Cell(15, 0, '', 0, 0, 'C');
        $this->fpdf->Cell($width_page - 30, 0, '', 1, 1, 'C');
        $this->fpdf->Cell(15, 0, '', 0, 1, 'C');
        $this->fpdf->Ln(3);
        $this->fpdf->MultiCell($width_page, 5, utf8text($name), 0, 'C');
        $this->fpdf->MultiCell($width_page, 5, utf8text($help_text), 0, 'C');
    }
    /**
     * Does something interesting
     *
     * @param Title    $title  Titulo del encabezado
     * @param Route  $logo La ruta del logo de la empresa
     * @param Extension  $ext_type La extensión del logo. [png, jpeg, jpg]
     * @author ZannetDev <zannetdev@facebook.com>
     * @return Null
     */ 
    public function Header($title, $logo, $ext_type = '')
    {
        // Logo
        $this->fpdf->Image($logo, 10, 6, 30, $ext_type);
        // Arial bold 15
        $this->fpdf->SetFont('Arial', 'B', 15);
        // Move to the right
        $this->fpdf->Cell(120);
        // Title
        $this->fpdf->Cell(30, 10, $title, 0, 1, 'C');
        // Line break
        $this->fpdf->Ln(20);
        $this->fpdf->Cell(0, 0, '', 1, 1, 'C');

    }
     /**
     * Does something interesting
     *
     * @param Titulo    $title  String que se imprime
     * @author ZannetDev <zannetdev@facebook.com>
     */ 
    public function Title($string){
        $this->fpdf->SetFont('Arial', 'B', 15);
        $this->fpdf->Cell(0,10, $string, 1,  1, 'C');
        $this->fpdf->SetFont('Arial', 'B', 10);

    }
}
