<?php

    $servidor = "localhost";
    $db = "php_proyecto";
    $username = "root";
    $password = "123456";

    try {   
        $conexion=new PDO("mysql:host=$servidor;dbname=$db",$username,$password);
        

    } catch (Exception $e) {
        echo $e->getMessage();

    }
    

  


?>