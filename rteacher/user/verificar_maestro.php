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
    <h1>¿Estas seguro que alguno de estos no es tu maestro?</h1>
    
    <?php
        include "../DBConfig.php";

        $conn = getConexionUsuario();
        if(mysqli_connect_errno($conn)){
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }

        $id_escuela = $_GET["id_escuela"];
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];

        echo "<form action=\"agregar_maestroDB.php?id_escuela=$id_escuela\" method=\"POST\">";
        echo "Nombre: <input type='text' name='nombre2'  value ='$nombre' readonly/><br>\n";
        echo "Apellido: <input type='text' name='apellidos2' value ='$apellidos' readonly/><br>\n";

        $sql = "SELECT id_maestro,Nombre,Apellidos FROM maestro
        WHERE (Nombre LIKE '%$nombre%' OR Apellidos LIKE '%$apellidos%') AND id_Escuela = $id_escuela;";
        $result = mysqli_query($conn, $sql);
        echo "<table border = '1'>\n";
        echo "  <tr>\n";
        echo "      <th>Nombre</th>\n";
        echo "      <th>Apellido</th>\n";
        echo "      <th>Ver</th>\n";
        echo "  </tr>\n";
        while($row = mysqli_fetch_array($result)){
            $id_maestro = $row[0];
            $nombre_m = $row[1];
            $apellidos_m = $row[2];
            echo "  <tr>\n";
            echo "      <td>$nombre_m</td>\n";
            echo "      <td>$apellidos_m</td>\n";
            echo "      <td><a href = 'ver_maestro.php?id_maestro=$id_maestro'>Ver</a></td>\n";
            echo "  </tr>\n";
        }
        echo "</table>\n";
        mysqli_close($conn);
        
    ?>
    <input type="submit" value="Agregar Maestro" name="agregarMaestro"/>
    </form>
</body>
</html>



