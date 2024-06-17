
<?php

require('../assets/library/fpdf/fpdf.php');
include '../back/conection.php'; // Archivo de conexión a la base de datos

class PDF_MC_Table extends FPDF
{
    // Propiedad para el número ascendente
    private $numero_ascendente = 1;

    // Método para reiniciar el número ascendente
    function ReiniciarNumeroAscendente()
    {
        $this->numero_ascendente = 1;
    }

    // Método para obtener el número ascendente actual y luego incrementarlo
    function ObtenerNumeroAscendente()
    {
        return $this->numero_ascendente++;
    }

    // Cabecera de página
    function Header()
    {
        $this->Image('../assets/images/unerg-logo.png', 10, 10, 50);
        $this->Image('../assets/images/unerg-logo.png', 240, 10, 50);
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 5, 'UNIVERSIDAD NACIONAL EXPERIMENTAL ROMULO GALLEGOS', 0, 1, 'C');
        $this->Ln(5);
        $this->Cell(0, 5, 'AREA DE ADMISIONES', 0, 1, 'C');
        $this->Ln(10);
        $this->Cell(0, 10, 'REPORTE DIARIO DE SOLICITUDES DE PREINSCRIPCION', 0, 1, 'C');
        $this->Ln(5);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'IB', 8);
        // Número de página
        $this->Cell(0, 10, 'SAIUNERG', 0, 0, 'C');
    }

    protected $widths;
    protected $aligns;
    protected $fontSize;
    protected $fontType;
    protected $textColor;

    function SetWidths($w)
    {
        // Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        // Set the array of column alignments
        $this->aligns = $a;
    }

    function SetFontSize($size)
    {
        // Set font size
        $this->fontSize = $size;
    }

    function SetFontType($type)
    {
        // Set font type (e.g., 'Arial', 'Times', etc.)
        $this->fontType = $type;
    }

    function SetTextColor($r, $g = null, $b = null)
    {
        // Set text color
        $this->textColor = array($r, $g, $b);
    }

    function HeaderRow($data)
    {
        // Set font properties
        $this->SetFont($this->fontType, 'B', $this->fontSize);
        $this->SetTextColor($this->textColor[0], $this->textColor[1], $this->textColor[2]);

        // Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x, $y, $w, $h);
            // Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        // Adjust position to the next line
        $this->Ln($h);
    }

    function Row($data)
    {
        // Set font properties
        $this->SetFont($this->fontType, '', $this->fontSize);
        $this->SetTextColor($this->textColor[0], $this->textColor[1], $this->textColor[2]);

        // Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x, $y, $w, $h);
            // Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        // Adjust position to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        // Compute the number of lines a MultiCell of width w will take
        if (!isset($this->CurrentFont))
            $this->Error('No font has been set');
        $cw = $this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', (string)$txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}

// Crear una instancia de la clase PDF_MC_Table
$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetMargins(20, 10, 20); // Márgenes
$pdf->SetAutoPageBreak(true, 15); // Salto de página automático

// Agregar una página al PDF (orientación horizontal)
$pdf->AddPage("Landscape");
$pdf->SetFont('Arial', '', 10);

// Consulta SQL para obtener datos de la tabla preinscripciones solo para el día actual
$sql = "SELECT nombres, apellidos, correo, nombre_carrera, cedula, tipo_ingreso, fecha_inscripcion
        FROM preinscripciones 
        WHERE DATE(fecha_inscripcion) = CURDATE()";
$result = $conn->query($sql);


$result = $conn->query($sql);

// Crear una instancia de la clase PDF_MC_Table
$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetMargins(20, 10, 20); // Márgenes
$pdf->SetAutoPageBreak(true, 15); // Salto de página automático

// Agregar una página al PDF (orientación horizontal)
$pdf->AddPage("Landscape");
$pdf->SetFont('Arial', '', 10);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Definir anchos de columna
    $pdf->SetWidths(array(10, 30, 30, 30, 70, 30, 30, 30));

    // Definir alineaciones
    $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C', 'C'));

    // Definir tamaño de fuente
    $pdf->SetFontSize(10);

    // Definir tipo de fuente
    $pdf->SetFontType('Arial');

    // Definir color de texto (opcional)
    $pdf->SetTextColor(0, 0, 0); // Negro

    // Agregar encabezado de la tabla
    $pdf->HeaderRow(array('Nro', 'NOMBRES', 'APELLIDOS', 'CEDULA', 'CORREO', 'CARRERA A INSCRIBIR', 'TIPO DE INGRESO', 'FECHA DE INSCRIPCION'));

    // Iterar sobre los resultados y agregar filas a la tabla del PDF
    while ($row = $result->fetch_assoc()) {
        // Obtener el número ascendente para la fila actual
        $numero_ascendente = $pdf->ObtenerNumeroAscendente();
        
        // Construir los datos de la fila (incluyendo el número ascendente)
        $data = array($numero_ascendente, $row["nombres"], $row["apellidos"], $row["cedula"], $row["correo"], $row["nombre_carrera"], $row["tipo_ingreso"], $row["fecha_inscripcion"]);
        $pdf->Row($data);
    }
} else {
    // Si no se encontraron resultados
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'No se encontraron usuarios.', 0, 1, 'C');
}

// Cerrar conexión a la base de datos
$conn->close();

// Salida del documento PDF
$pdf->Output();
?>