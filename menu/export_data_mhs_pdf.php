<?php
$kdb = koneksidatabase();
forma(); 
mysqli_close($kdb);

function forma()
{
ob_start();
require('../framework/fpdf17/fpdf.php');  
class PDF extends FPDF
{
function Header()
{
$this->SetFont('Arial','B',11);
$this->Cell(40);
$this->Cell(250,8,'DATA MAHASISWA',0,1,'C');   	
$this->SetFont('Arial','B',14);
$this->Cell(40);
$this->Image('../logo/polinela.png',3,3,0,20);	
$this->Cell(250,6,'POLITEKNIK NEGERI LAMPUNG',0,1,'C');
$this->SetFont('Arial','',7);    
$this->Cell(40);	
$this->Line(10, 30, 345, 30);
}
function Footer()
{
$this->Cell(250,6,'POLITEKNIK NEGERI LAMPUNG',0,1,'C');
$this->Line(10, 283, 200, 283);
$this->SetY(-15);
$this->SetFont('Arial','I',7);
$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}'.', print date '.date('d/m/Y').', MI-SIWEB-'.date('Y'),0,0,'R');
}
}

$hasil = sql_select();
$i=1;
$pdf=new PDF('L','mm','legal'); // FORM A
$pdf->SetCreator('fpdf');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetXY(12,30);
$pdf->SetX(10); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'No.',0,0);
$pdf->SetX(18); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'NPM ',0,0);
$pdf->SetX(35); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Nama ',0,0);
$pdf->SetX(65); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'JK ',0,0);
$pdf->SetX(70); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Tempat Lahir ',0,0);
$pdf->SetX(93); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Tgl. Lahir ',0,0);
$pdf->SetX(115); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Agama ',0,0);
$pdf->SetX(125); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Tahun ',0,0);
$pdf->SetX(135); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Jalurmasuk',0,0);
$pdf->SetX(160); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Alamat',0,0);
$pdf->SetX(220); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Kodepos',0,0);
$pdf->SetX(240); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'No HP',0,0);
$pdf->SetX(270); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Email',0,0);
$pdf->SetX(300); $pdf->SetFont('Arial','',9); $pdf->Cell(0,6,'Foto',0,0);

$pdf->SetXY(10,40); 
$i=1; $baris1=40;
while($mhs = mysqli_fetch_assoc($hasil))
{
$pdf->SetXY(10,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$i,0,1);
$pdf->SetXY(18,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["npm"],0,1);
$pdf->SetXY(35,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["nama"],0,1);
$pdf->SetXY(65,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["sex"],0,1);
$pdf->SetXY(70,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["tmp_lahir"],0,1);
$pdf->SetXY(93,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["tgl_lahir"],0,1);
$pdf->SetXY(115,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["nmagama"],0,1);
$pdf->SetXY(125,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["tahun"],0,1);
$pdf->SetXY(135,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["nmjalurmasuk"],0,1);
$pdf->SetXY(160,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["alamat_jln"],0,1);
$pdf->SetXY(220,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["kodepos"],0,1);
$pdf->SetXY(240,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["nohp"],0,1);
$pdf->SetXY(270,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["email"],0,1);
$pdf->SetXY(300,$baris1); $pdf->SetFont('Arial','',8); $pdf->Cell(0,4,$mhs["photo"],0,1);
$baris1 = $baris1 + 4;
$i++;
}  
$pdf->SetTitle('DATA MAHASIWA',TRUE);
$pdf->SetSubject('POLITEKNIK NEGERI LAMPUNG');
$filepdf='exportdata.pdf';
$pdf->Output($filepdf,'i');
$pdf->Close();
}

function koneksidatabase()
{
    include('../koneksi/koneksi.php');
	return $kdb;
}

function sql_select()
{
  global $kdb;
  $sql =  " select a.*, b.nmagama, c.tahun, d.nmjalurmasuk from mahasiswa as a, agama as b, tahun as c, 
  jalurmasuk as d where b.idagama = a.idagama and
  c.idtahun = a.idtahun and d.idjalurmasuk = a.idjalurmasuk "; 
  $res = mysqli_query($kdb, $sql) or die(mysql_error());
  return $res;
}

