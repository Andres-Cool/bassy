<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('View/img/logo.png', 18, 15, 33);
        // Arial bold 15
        $this->Ln(30);
        $this->SetFont('Arial', 'B', 30);
        // Movernos a la derecha
        $this->Cell(70);
        // Título
        $this->Cell(55, 10, 'REPORTE GENERAL', 0, 0, 'C'); //en c es l izquierda, r derecha y c centrado
        // Salto de línea
        $this->Ln(25);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-20);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8); // la i es para decir que sea cursiva la letra
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C'); // nb es el total de las paginas
    }
}
