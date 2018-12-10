<?php
    session_start();
    if(isset($_SESSION["id_usuario"])){
        $id_usuario = $_SESSION["id_usuario"];
    } else{
        echo "<script>";
        echo "alert(\"¡Necesitas registrarte votar!\");\n";
        echo "window.location.href = \"log_in.php\"";
        echo "</script>";
    }    

    $id_calificacion = $_GET["id_cal"];

    include "../DBConfig.php";

    $conn = getMySQLi();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    } 

    $sql = "DELETE FROM votos WHERE id_calificacion = $id_calificacion AND id_usuario = $id_usuario";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>";
        echo "window.history.back();";
        echo "</script>";
    } else{
        echo "<script>";
        echo "alert(\"Ups! Parece que algo salio mal :(\");\n";
        echo "window.history.back();";
        echo "</script>";
        exit;
    }
?>