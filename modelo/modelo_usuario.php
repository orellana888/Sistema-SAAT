<?php
    class Modelo_Usuario{
        private $conexion;
        function __construct(){
            require_once 'modelo_conexion.php';
            $this->conexion = new conexion();
            $this->conexion->conectar();
        }

        function VerificarUsuario($usuario,$contra){
            $sql = "call SP_VERIFICAR_USUARIO('$usuario')";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    if(password_verify($contra, $consulta_VU["usu_contrasena"]))
                    {
                        $arreglo[] = $consulta_VU;
                    }
                }
                return $arreglo; 
                $this->conexion->cerrar();
            }
        }

        function listar_combo_colegios(){
            $sql = "call SP_COMBO_COLEGIO_CIMEQH()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function listar_combo_colegios_cich(){
            $sql = "call SP_COMBO_COLEGIO_CICH()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function listar_combo_colegios_cah(){
            $sql = "call SP_COMBO_COLEGIO_CAH()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function listar_cimeqh(){
            $sql = "call SP_MOSTRAR_CIMEQH()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        
        function listar_cich(){
            $sql = "call SP_MOSTRAR_CICH()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function listar_cah(){
            $sql = "call SP_MOSTRAR_CAH()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function TraerDatos($usuario){
            $sql = "call SP_VERIFICAR_USUARIO('$usuario')";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function listar_usuario(){
            $sql = "call SP_LISTAR_USUARIO()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_assoc($consulta)) {
                    $arreglo["data"][]=$consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function RegistrarCimeqh($expediente,$proyecto,$propietario,$catrastal,$area,$presupuesto,$colegiado,$estatus,$observaciones,$fecha){
            $sql = "call SP_REGISTRAR_APROBADO_CIMEQH('$expediente','$proyecto','$propietario','$catrastal','$area','$presupuesto','$colegiado','$estatus','$observaciones','$fecha')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                $this->conexion->conexion->next_result(); // Limpiar el conjunto de resultados
                $this->conexion->cerrar();
                return true; // Opcionalmente, puedes retornar true si la operación fue exitosa
            } else {
                return false; // Opcionalmente, puedes retornar false si la operación falló
            }
        }
 
        function RegistrarCich($expediente,$proyecto,$propietario,$catrastal,$area,$presupuesto,$colegiado,$estatus,$observaciones,$fecha){
            $sql = "call SP_REGISTRAR_APROBADO_CICH('$expediente','$proyecto','$propietario','$catrastal','$area','$presupuesto','$colegiado','$estatus','$observaciones','$fecha')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                $this->conexion->conexion->next_result(); // Limpiar el conjunto de resultados
                $this->conexion->cerrar();
                return true; // Opcionalmente, puedes retornar true si la operación fue exitosa
            } else {
                return false; // Opcionalmente, puedes retornar false si la operación falló
            }
        }

        function RegistrarCah($expediente,$proyecto,$propietario,$catrastal,$area,$presupuesto,$colegiado,$estatus,$observaciones,$fecha){
            $sql = "call SP_REGISTRAR_APROBADO_CAH('$expediente','$proyecto','$propietario','$catrastal','$area','$presupuesto','$colegiado','$estatus','$observaciones','$fecha')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                $this->conexion->conexion->next_result(); // Limpiar el conjunto de resultados
                $this->conexion->cerrar();
                return true; // Opcionalmente, puedes retornar true si la operación fue exitosa
            } else {
                return false; // Opcionalmente, puedes retornar false si la operación falló
            }
        }

        function listar_combo_rol(){
            $sql = "call SP_LISTAR_COMBO_ROL()";
            $arreglo = array();
            if ($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta)) {
                        $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function Modificar_Estatus_Usuario($idusuario,$estatus){
            $sql = "call SP_MODIFICAR_ESTATUS_USUARIO('$idusuario','$estatus')";
			if ($consulta = $this->conexion->conexion->query($sql)){
                return 1;
			}else{
                return 0;
            }
        }

        function Modificar_Contra_Usuario($idusuario,$contranu){
            $sql = "call SP_MODIFICAR_CONTRA_USUARIO('$idusuario','$contranu')";
			if ($consulta = $this->conexion->conexion->query($sql)){
                return 1;
			}else{
                return 0;
            }
        }
 

        function Registrar_Usuario($usuario,$contra,$rol){
            $sql = "call SP_REGISTRAR_USUARIO('$usuario','$contra','$rol')";
            if ($consulta = $this->conexion->conexion->query($sql)) {
                if ($row = mysqli_fetch_array($consulta)) {
                        return $id= trim($row[0]);
                }
                $this->conexion->cerrar();
            }
        }

        function TraerDatosArea_CIMEQH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_AREA_CIMEQH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosPresupuesto_CIMEQH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_PRESUPUESTO_CIMEQH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosInspeccion_CIMEQH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_INSPECCION_CIMEQH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosArea_CAH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_AREA_CAH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosPresupuesto_CAH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_PRESUPUESTO_CAH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosInspeccion_CAH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_INSPECCION_CAH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosArea_CICH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_AREA_CICH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosPresupuesto_CICH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_PRESUPUESTO_CICH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }
        function TraerDatosInspeccion_CICH($fecha_inicial,$fecha_final)
        {
            $sql = "call SP_INSPECCION_CICH('$fecha_inicial', '$fecha_final');";
            $arreglo = array();

            if($consulta = $this->conexion->conexion->query($sql)) {
                while ($consulta_VU = mysqli_fetch_array($consulta))
                {
                    $arreglo[] = $consulta_VU;
                }
                return $arreglo;
                $this->conexion->cerrar();
            }
        }

        function Actualizar_Cimeqh($expediente, $proyecto, $propietario, $catastral, $area, $presupuesto, $colegiado, $estatus, $observaciones, $fecha)
            {
                $sql = "CALL SP_ACTUALIZAR_CIMEQH('$expediente', '$proyecto', '$propietario', '$catastral', $area, $presupuesto, '$colegiado', '$estatus', '$observaciones', '$fecha');";
                

                if ($consulta = $this->conexion->conexion->query($sql)) {
                    return 1;
                }
                else{
                    return 0;
                }
            }

            function Actualizar_Cah($expediente, $proyecto, $propietario, $catastral, $area, $presupuesto, $colegiado, $estatus, $observaciones, $fecha)
            {
                $sql = "CALL SP_ACTUALIZAR_CAH('$expediente', '$proyecto', '$propietario', '$catastral', $area, $presupuesto, '$colegiado', '$estatus', '$observaciones', '$fecha');";
                

                if ($consulta = $this->conexion->conexion->query($sql)) {
                    return 1;
                }
                else{
                    return 0;
                }
            }
            function Actualizar_Cich($expediente, $proyecto, $propietario, $catastral, $area, $presupuesto, $colegiado, $estatus, $observaciones, $fecha)
            {
                $sql = "CALL SP_ACTUALIZAR_CICH('$expediente', '$proyecto', '$propietario', '$catastral', $area, $presupuesto, '$colegiado', '$estatus', '$observaciones', '$fecha');";
                

                if ($consulta = $this->conexion->conexion->query($sql)) {
                    return 1;
                }
                else{
                    return 0;
                }
            }

            function DescargarCsv($tabla)
            {
                $sql = "SELECT * FROM $tabla";
                $query = $this->conexion->conexion->query($sql);

                if($query->num_rows > 0)
                {
                    $delimiter = ",";
                    $filename = "$tabla" . date('d-m-Y') . ".csv";
                    
                    //create a file pointer
                    $f = fopen('php://memory', 'w');
                    
                    //set column headers
                    // campos del archivo CSV
                    $fields = array('Numero de Expediente', 'Colegio', 'Tipo de Proyecto', 'Propietario', 'Clave Catastral', 'Area', 'Presupuesto', 'Colegiado', 'Estatus', 'Observaciones', 'Fecha de Registro', 'Fecha de Modificacion');
                    // separador de campos
                    $delimiter = ',';

                    // escribir los campos como la primera línea del archivo CSV
                    fputcsv($f, $fields, $delimiter);

                    // consulta a la base de datos
                    

                    // recorrer los resultados y escribirlos en el archivo CSV
                    while($row = $query->fetch_assoc()){
                    // procesar los datos antes de escribirlos en el archivo
                    
                    $lineData = array($row['num_expediente'], $row['nombre_col'], $row['tipo_proyecto'], $row['propietario'], $row['clave_catastral'], $row['area'], $row['presupuesto'], $row['colegiado'], $row['estatus'], $row['Observaciones'], $row['fecha'], $row['fecha_mod']);
                    // escribir los datos en el archivo CSV
                    fputcsv($f, $lineData, $delimiter);
                    }
                    
                    //move back to beginning of file
                    fseek($f, 0);
                    
                    //set headers to download file rather than displayed
                    header('Content-Type: text/csv');
                    header('Content-Disposition: attachment; filename="' . $filename . '";');
                    
                    //output all remaining data on a file pointer
                    fpassthru($f);
                }
            }
        
    }
?>