<?php
    include 'verificar_credenciales.php';
    verificar();
?>

<!DOCTYPE html>
<html lang="en">
<link href="css\style.css" rel="stylesheet" type="text/css" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=7, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Escuelas</title>
</head>
<body>
    <?php
        include "../DBConfig.php";

        //Conexion con la base de datos
        $conn = getConexionUsuario();
        $id_dep = $_GET["id"];
        if(mysqli_connect_errno($conn))
        {
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }

        $sql = "SELECT id_materias,Nombre FROM materias WHERE id_departamento = $id_dep ORDER BY Nombre";
        $result = mysqli_query($conn, $sql);
        echo "<table border = 1>";
        echo "  <tr>";
        echo "      <th>Materia</th>";
        echo "      <th>Eliminar</th>";
        echo "  </tr>";
        while($row = mysqli_fetch_array($result)){
            $id = $row[0];
            $materia = $row[1];
            $url = "eliminar_mat.php?id=$id";
            echo "  <tr>";
            echo "      <td>$materia</td>";
            echo "      <td><a href=$url>Eliminar</a></td>";
            echo "  </tr>";
        }
        echo "</table>";
        //Terminar la conexion con la base datos
        mysqli_close($conn);
        
    ?>

    <form action="" method="post">
        <p>Materia: <input type="text" name="materia" id=""></p>
        <input type="submit" value="Agregar" name = "agregar">
    </form>
    
</body>
</html>

<?php
    if(isset($_POST["agregar"])){
        $materia_nueva = $_POST["materia"];
        $conn = getMySQLi();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            exit;
        } 
        
        $sql = "INSERT INTO materias(Nombre,id_departamento) VALUES ('$materia_nueva',$id_dep)";
        $conn->query($sql);
        $conn->close();
        echo "<script>";
        echo "window.location.href = \"ver_materias.php?id=$id_dep\"";
        echo "</script>";
    }
?>