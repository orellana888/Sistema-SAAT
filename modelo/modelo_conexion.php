<?php
    class conexion{
        public $servidor;
        public $usuario;
        public $contrasena;
        public $basedatos;
        public $conexion;
        public function __construct(){
                $this->servidor = "localhost";
                $this->usuario = "root";
                $this->contrasena = "1234567";
                $this->basedatos = "bd_sistema";
        }
        function conectar(){
            $this->conexion = new mysqli($this->servidor,$this->usuario,$this->contrasena,$this->basedatos);
            $this->conexion->set_charset("utf8");
        }
        function cerrar(){
            $this->conexion->close();
        }
    }
?>