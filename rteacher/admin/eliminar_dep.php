<?php
    include 'verificar_credenciales.php';
    verificar();
?>

<?php
    $id_dep = $_GET["id"];
    include "../DBConfig.php";

    $conn = getMySQLi();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    } 

    $sql = "DELETE FROM departamento WHERE id_departamento = $id_dep";
    
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