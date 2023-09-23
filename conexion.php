<?php
$servidor = "localhost";
$username = "root";
$password = "";

// Conectar al servidor MySQL
$conn = new mysqli($servidor, $username, $password);

// Verificar la conexión
if (!$conn) {
    die("La conexión a MySQL falló: " . mysqli_connect_error());
}

$db = "php_proyecto";

// Consulta SQL para crear la base de datos si no existe
$sql = "CREATE DATABASE IF NOT EXISTS $db";

if (mysqli_query($conn, $sql)) {
    // Mostrar mensajes en la consola del navegador
    echo '<script>';
    echo 'console.log("Base de datos creada correctamente o ya existe.");';
    echo '</script>';
} else {
    echo "Error al crear la base de datos: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);

// Abro nueva conexión pero directamente a la base de datos
$connect = new mysqli($servidor, $username, $password, $db);

$tableName = "employee";

//Consulta SQL para la creacion de la Tabla
$sqlCreate = "
        CREATE TABLE IF NOT EXISTS $tableName (
            id INT AUTO_INCREMENT PRIMARY KEY,
            cedula BIGINT NOT NULL,
            nombre VARCHAR(50) NOT NULL,
            apellido VARCHAR(50) NOT NULL,
            direccion TEXT NOT NULL,
            telefono BIGINT NOT NULL
        );";

if (mysqli_query($connect, $sqlCreate)) {
    // Mostrar mensajes en la consola del navegador
    echo '<script>';
    echo 'console.log("Creación de la tabla correcta o ya existía.");';
    echo '</script>';
} else {
    echo "Error al crear la tabla" . mysqli_error($connect);
}
?>

