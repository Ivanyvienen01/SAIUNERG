<?php
require('../assets/library/fpdf/fpdf.php');
include 'conection.php'; // Archivo de conexión a la base de datos

class PDF_MC_Table extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('../assets/images/unerg-logo.png',5,5,30);
        $this->SetFont('Times','B',12);
        $this->Cell(0,5,'UNIVERSIDAD NACIONAL EXPERIMENTAL ROMULO GALLEGOS',0,1,'C');
        $this->Cell(0,5,'AREA DE INGENIERIA DE SISTEMAS',0,1,'C');
        $this->Cell(0,10,'PENSUM DE ESTUDIO',0,1,'C');
        $this->Cell(0,10,'ID DE CARRERA: 4 - INGENIERIA CIVIL',0,1,'C');
        $this->Ln(5);
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-10);
        // Arial italic 8
        $this->SetFont('Arial','IB',8);
        // Número de página
        $this->Cell(0,10,'SAIUNERG',0,0,'C');
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

    function Row($data)
    {
        // Set font properties
        $this->SetFont($this->fontType, '', $this->fontSize);
        $this->SetTextColor($this->textColor[0], $this->textColor[1], $this->textColor[2]);

        // Calculate the height of the row
        $nb = 0;
        for($i=0;$i<count($data);$i++)
            $nb = max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h = 5*$nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x,$y,$w,$h);
            // Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            // Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
        
    }

    function NbLines($w, $txt)
    {
        // Compute the number of lines a MultiCell of width w will take
        if(!isset($this->CurrentFont))
            $this->Error('No font has been set');
        $cw = $this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r",'',(string)$txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb)
        {
            $c = $s[$i];
            if($c=="\n")
            {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep = $i;
            $l += $cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i = $sep+1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
}

// Crear una instancia de la clase PDF_MC_Table
$pdf = new PDF_MC_Table();
$pdf->AliasNbPages();
$pdf->SetMargins(10, 10, 10); // Márgenes
$pdf->SetAutoPageBreak(true, 15); // Salto de página automático

// Agregar una página
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Consulta SQL para obtener datos de la tabla (ajusta según tu caso)
$sql = "SELECT semestre, cod_asignatura, nombre_asignatura, horas_teoricas, horas_practicas, horas_semanales, UC, prelaciones  FROM pensum_ingenieria_civil ORDER BY semestre, cod_asignatura";
$result = $conn->query($sql);

// Verificar si se obtuvieron resultados
if ($result->num_rows > 0) {
    // Definir anchos de columna
    $pdf->SetWidths(array(20, 50, 20, 20, 20, 15, 50));

    // Definir alineaciones
    $pdf->SetAligns(array('C', 'C', 'C', 'C', 'C', 'C', 'C'));

    // Definir tamaño de fuente
    $pdf->SetFontSize(10);


    // Definir tipo de fuente
    $pdf->SetFontType('Arial');

    // Definir color de texto (opcional)
    $pdf->SetTextColor(0, 0, 0, 0, 0, 0, 0); // Negro

    $previous_semester = '';
    // Iterar sobre los resultados y agregar filas a la tabla
    while ($row = $result->fetch_assoc()) {
        if ($previous_semester != $row['semestre']) {
            if ($previous_semester != '') {
                $pdf->Ln(20); // Agregar una fila para separar los semestres
            }
            // Agregar la fila con el número de semestre
            $pdf->Cell(195, 10, 'Semestre ' . $row['semestre'], 1, 1, 'C');
            $pdf->Row(array('Cod.', 'Nombre de la Asignatura', 'Horas Teoricas', 'Horas Practicas', 'Horas Semanales', 'U.C', 'prelaciones'));
            $previous_semester = $row['semestre'];
            
        }
        $data = array($row["cod_asignatura"], $row["nombre_asignatura"], $row["horas_teoricas"], $row["horas_practicas"], $row["horas_semanales"], $row["UC"], $row["prelaciones"]);
        $pdf->Row($data);
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar conexión a la base de datos
$conn->close();

// Salida del documento
$pdf->Output();
?>
