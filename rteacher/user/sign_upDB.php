<?php
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $password_conf = $_POST["password_conf"];
    $id_escuela = $_POST["escuela"];

    if($password != $password_conf){
        echo "<script>";
        echo "alert(\"Las contraseñas no coinciden\");\n";
        echo "window.history.back();";
        echo "</script>";
    }

    include "../DBConfig.php";

    $conn = getMySQLi();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    } 

    $sql = "INSERT INTO usuario (username,nombre,apellido,id_escuela,id_nivelUsuario,password) 
    VALUES ('$username','$nombre','$apellidos',$id_escuela,3,$password);";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../log_in.php");
    } else{
        
        $error = $conn->error;
        echo "<script>";
        echo "alert(\"$error\");\n";
        echo "window.history.back();";
        echo "</script>";
        exit;
    }
?>