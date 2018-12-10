<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<link href="css\style.css" rel="stylesheet" type="text/css" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RTeacher</title>
</head>
<body>
    <h1>Agregar Maestro</h1>
    
    <?php
        $id_escuela = $_GET["id_escuela"];
        if(isset($_SESSION["id_usuario"])){
            $id_escuela_user = $_SESSION["id_escuela"];
            if($id_escuela != $id_escuela_user){
                echo "<script>";
                echo "alert(\"¡Solo puedes agregar maestros de tu escuela!\");\n";
                echo "window.history.back();";
                echo "</script>";
            }
            $bloqueado = $_SESSION["bloqueado"];
            if($bloqueado == 1){
                echo "<script>";
                echo "alert(\"¡Lo sentimo! Haz sido bloqueado :(\");\n";
                echo "window.history.back();";
                echo "</script>";
            }
        } else{
            echo "<script>";
            echo "alert(\"¡Necesitas registrarte para agregar maestros!\");\n";
            echo "window.location.href = \"log_in.php\"";
            echo "</script>";
        }
        echo "<form action=\"verificar_maestro.php?id_escuela=$id_escuela\" method=\"post\">";    
    ?>
        <p>Nombre: <input type="text" name = "nombre" required></p>
        <p>Apellidos: <input type="text" name = "apellidos" required></p>
        <input type="submit" value = "Agregar">
    </form>
</body>
</html>