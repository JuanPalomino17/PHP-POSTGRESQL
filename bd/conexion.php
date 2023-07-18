<?php
class Conexion
{
    public static function Conectar()
    {
        define('servidor', 'localhost');
        define('nombre_bd', 'pruebas');
        define('usuario', 'postgres');
        define('password', 'prueba123');
        $opciones = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $conexion = new PDO("pgsql:host=" . servidor . ";dbname=" . nombre_bd, usuario, password, $opciones);
            $conexion->exec("SET NAMES 'UTF8'");
            return $conexion;
        } catch (Exception $e) {
            die("El error de Conexión es: " . $e->getMessage());
        }
    }
}



