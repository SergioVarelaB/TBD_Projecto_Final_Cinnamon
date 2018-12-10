<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<link href="user\css\style.css" rel="stylesheet" type="text/css" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RTeacher</title>
</head>
<body>
    <form action="" method="post">
        <p>Username: <input type="text" name="username" id="" required></p>
        <p>Contraseña: <input type="password" name="password" id="" required></p>
        <input type="submit" value="Entrar" name = "entrar">
    </form>
</body>
</html>

<?php 
    if(isset($_POST["entrar"])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        include "DBConfig.php";

        $conn = getConexionUsuario();
        if(mysqli_connect_errno($conn))
        {
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }
    
        $sql = "SELECT * FROM usuario WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if($row){
            $id_usuario = $row["id_Usuario"];
            $nivel_usuario = $row["id_nivelUsuario"];
            $bloqueado = $row["bloqueado"];
            $id_escuela = $row["id_escuela"];
            $_SESSION["id_usuario"] = $id_usuario;
            $_SESSION["nivel_usuario"] = $nivel_usuario;
            $_SESSION["bloqueado"] = $bloqueado; 
            $_SESSION["id_escuela"] = $id_escuela;
            //echo $_SESSION["id_usuario"];
            if($nivel_usuario == 1){
                //ir  a menu administrador
                echo "<script>";
                echo "alert(\"¡Bienvenido!\");\n";
                echo "</script>";
                header("Location: admin/menu.php");
            } else{
                if($nivel_usuario ==3){
                    echo "<script>";
                    echo "alert(\"¡Bienvenido!\");\n";
                    echo "</script>";
                    header("Location: user/ver_escuelas.php");
                }
            }
            
            
        } else{
            echo "<script>";
            echo "alert(\"El usuario y la contraseña no coinciden :(\");\n";
            echo "window.history.back();";
            echo "</script>";
        }
    }
?>