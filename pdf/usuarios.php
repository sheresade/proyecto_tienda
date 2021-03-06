<?php
require('./font/fpdf.php');
require('../plantilla/db_configuration.php');
include_once('../plantilla/configuration_instalacion.php');
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($connection->connect_errno) {
	printf("Connection failed: %s\n", $connection->connect_error);
	exit();

}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../imagenes/logotipo/LOGO.png' , 10 ,10, 20 , 15,'PNG');

$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, '', 0);
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(50, 0, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Courier', 'B', 20);
$pdf->Cell(50, 0, '', 0);
$pdf->SetTextColor(44, 212, 204);
$pdf->Cell(85, 25, 'LISTADO DE USUARIOS', 0);
$pdf->Ln(23);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(44, 212, 204);//color de la cabecera de la tabla


//datos par la tabla
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(22, 8, 'COD_USUARIO',1,0,"C",'True');
$pdf->Cell(20, 8, 'NOMBRE', 1,0,"C",'True');
$pdf->Cell(30, 8, 'APELLIDOS', 1,0,"C",'True');
$pdf->Cell(20, 8, 'DNI', 1,0,"C",'True');
$pdf->Cell(25, 8, 'LOCALIDAD', 1,0,"C",'True');
$pdf->Cell(25, 8, 'PROVINCIA', 1,0,"C",'True');
$pdf->Cell(20, 8, 'PAIS', 1,0,"C",'True');
$pdf->Cell(32, 8, 'PAIS', 1,0,"C",'True');
$pdf->Ln(8);
$pdf->SetFillColor(161,247,243);//color del cuerpo  de la tabla


$pdf->SetFont('Arial', '', 8);
//CONSULTA
$connection->set_charset("utf8");
$usuarios = $connection->query("SELECT * FROM usuarios");

while($obj = $usuarios->fetch_object()){

	$pdf->Cell(22, 8, $obj->codusuario, 1,0,"C",'True');
	$pdf->Cell(20, 8,$obj->Nombre, 1,0,"C",'True');
	$pdf->Cell(30, 8, $obj->apellido, 1,0,"C",'True');
	$pdf->Cell(20, 8, $obj->dni, 1,0,"C",'True');
  $pdf->Cell(25, 8, $obj->localidad, 1,0,"C",'True');
  $pdf->Cell(25, 8, $obj->provincia, 1,0,"C",'True');
	  $pdf->Cell(20, 8, $obj->pais, 1,0,"C",'True');
		  $pdf->Cell(32, 8, $obj->direccion, 1,0,"C",'True');
	$pdf->Ln(8);
}
$pdf->SetFont('Arial', 'B', 8);
//$pdf->Output('listauser.pdf','D');
$pdf->Output();
?>
