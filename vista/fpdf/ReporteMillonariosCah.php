<?php

if(!empty($_GET["fecha_inicial"]) and !empty($_GET["fecha_final"]))
{
   require('./fpdf.php');

   date_default_timezone_set('America/Tegucigalpa');
   $fecha_inicial = $_GET["fecha_inicial"];
   $fecha_final = $_GET["fecha_final"];


   class PDF extends FPDF
   {
      private $fecha_inicial;
      private $fecha_final;

      function __construct($fecha_inicial, $fecha_final)
      {
         parent::__construct();
         $this->fecha_inicial = $fecha_inicial;
         $this->fecha_final = $fecha_final;
         $this->fecha1 = date("d/m/Y", strtotime($fecha_inicial));
         $this->fecha2 = date("d/m/Y", strtotime($fecha_final));
      }
      // Cabecera de página
      function Header()
      {
         
        $this->Image('cah.jpeg', 220, 6, 50); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
         $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
         $this->Cell(95); // Movernos a la derecha
         $this->SetTextColor(0, 0, 0); //color
         //creamos una celda o fila
         // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
         $this->Ln(0); // Salto de línea
         $this->SetTextColor(103); //color

         /* UBICACION */
         $this->Cell(1);  // mover a la derecha
         $this->SetFont('Arial', 'B', 10);
         $this->Cell(96, 10, utf8_decode("Ubicación : San Pedro Sula"), 0, 0, '', 0);
         $this->Ln(6);

         /* TELEFONO */
         $this->Cell(1);  // mover a la derecha
         $this->SetFont('Arial', 'B', 10);
         $this->Cell(59, 10, utf8_decode("Teléfono : 9669-0746"), 0, 0, '', 0);
         $this->Ln(5);

         /* COREEO */
         $this->Cell(1);  // mover a la derecha
         $this->SetFont('Arial', 'B', 10);
         $this->Cell(85, 10, utf8_decode("Correo : capnor@cimeqh.org"), 0, 0, '', 0);
         $this->Ln(22);

         

         /* TITULO DE LA TABLA */
         //color
         
         $this->SetTextColor(199, 161, 46);
         $this->Cell(100); // mover a la derecha
         $this->SetFont('Arial', 'B', 13);
         $this->Cell(75, 10, utf8_decode("REPORTE DE PROYECTOS MILLONARIOS"), 0, 1, 'C', 0);
         $this->SetFont('Arial', 'B', 11);
         $this->Cell(270, 10, utf8_decode($this->fecha1 . ' a ' . $this->fecha2), 0, 0, 'C', 0);
         $this->Ln(12);

         /* CAMPOS DE LA TABLA */
         //color
         $this->SetFillColor(199, 140, 46); //colorFondo
         $this->SetTextColor(255, 255, 255); //colorTexto
         $this->SetDrawColor(163, 163, 163); //colorBorde
         $this->Cell(3.5);
         $this->SetFont('Arial', 'B', 9);
         $this->Cell(40, 10, utf8_decode('N° DE EXPEDIENTE'), 1, 0, 'C', 1);
         $this->Cell(35, 10, utf8_decode('PRESUPUESTO'), 1, 0, 'C', 1);
         $this->Cell(25, 10, utf8_decode('AREA'), 1, 0, 'C', 1);
         $this->Cell(45, 10, utf8_decode('CLAVE CATASTRAL'), 1, 0, 'C', 1);
         $this->Cell(85, 10, utf8_decode('TIPO DE CONSTRUCCIÓN'), 1, 0, 'C', 1);
         $this->Cell(40, 10, utf8_decode('ÚLTIMA MODIFICACIÓN'), 1, 1, 'C', 1);
         
         
      }

      // Pie de página
      function Footer()
      {
         $this->SetY(-15); // Posición: a 1,5 cm del final
         $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
         $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

         $this->SetY(-15); // Posición: a 1,5 cm del final
         $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
         $hoy = date('d/m/Y');
         $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
      }
   }

   include '../../modelo/modelo_conexion.php';
   $conexion = new conexion();
   $conexion->conectar();
   

   $pdf = new PDF($fecha_inicial,$fecha_final);
   $pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
   $pdf->AliasNbPages(); //muestra la pagina / y total de paginas

   $i = 0;
   $pdf->SetFont('Arial', '', 9);
   $pdf->SetDrawColor(163, 163, 163); //colorBorde
   
   $consulta_reporte = $conexion->conexion->query("CALL SP_MILLONARIOS_CAH('$fecha_inicial','$fecha_final')");

   while ($datos_reporte = $consulta_reporte->fetch_object()) {      
      
   $i = $i + 1;
   $pdf->Cell(3.5);
   /* TABLA */
   $pdf->Cell(40, 9, utf8_decode($datos_reporte->num_expediente), 1, 0, 'C', 0);
   $pdf->Cell(35, 9, utf8_decode("Lps." . "" .number_format($datos_reporte->presupuesto,2,'.',',')), 1, 0, 'C', 0);
   $pdf->Cell(25, 9, utf8_decode(number_format($datos_reporte->area, 0, '.', ',') . " " . "m²"), 1, 0, 'C', 0);
   $pdf->Cell(45, 9, utf8_decode($datos_reporte->clave_catastral), 1, 0, 'C', 0);
   $pdf->Cell(85, 9, utf8_decode($datos_reporte->tipo_proyecto), 1, 0, 'C', 0);
   $pdf->Cell(40, 9, utf8_decode($datos_reporte->fecha), 1, 1, 'C', 0);
   }

   
   $pdf->Output("ReporteProyectosMillonariosCAH-$fecha_inicial-$fecha_final.pdf", 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
   $consulta_reporte->close();
 }
 else
 {
   echo("error");
 }
