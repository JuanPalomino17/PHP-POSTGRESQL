<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS

$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$telefono = (isset($_POST['telefono'])) ? $_POST['telefono'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        try {
            // Insertar el nuevo registro
            $consulta = "INSERT INTO usuarios (nombre, telefono, correo) VALUES ('$nombre', '$telefono', '$correo') ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $consulta = "SELECT id, nombre, telefono, correo FROM usuarios ORDER BY id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
        break;
    case 2: //modificación
        try {
            $consulta = "UPDATE usuarios SET nombre='$nombre', telefono='$telefono', correo='$correo' WHERE id='$id' ";       
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $consulta = "SELECT id, nombre, telefono, correo FROM usuarios WHERE id='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
        break;
    case 3://baja
        try {
            $consulta = "DELETE FROM usuarios WHERE id='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data = array('success' => true);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;