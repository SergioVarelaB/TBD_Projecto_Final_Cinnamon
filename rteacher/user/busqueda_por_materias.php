<!DOCTYPE html>
<html lang="en">
<link href="css\style.css" rel="stylesheet" type="text/css" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RTeacher</title>
</head>
<body>
    <?php
        include "../DBConfig.php";

        $conn = getConexionUsuario();
        if(mysqli_connect_errno($conn))
        {
            echo 'No se pudo hacer la conexión con la base de datos';
            exit;
        }

        $id_escuela = $_GET["id_escuela"];
        $materia = $_POST["materia"];

        echo "<p><a href = 'busqueda_avanzada.php?id_escuela=$id_escuela'>Busqueda avanzada</a></p>";

        $sql = "SELECT 	a.Nombre, a.Apellidos, calcular_promedio_general(a.id_maestro), calcular_dificultad(a.id_maestro), 
                porcentaje_volver_a_tomar(a.id_maestro), a.id_maestro
                FROM maestro a
                INNER JOIN calificacion b ON a.id_maestro = b.id_maestro
                WHERE a.id_Escuela = $id_escuela  AND b.id_materias = $materia;";
        $result = mysqli_query($conn, $sql);
        //echo mysqli_error($conn);
        echo "<table border = 1>";
        echo "  <tr>";
        echo "      <th>Nombre</th>";
        echo "      <th>Calificacion promedio</th>";
        echo "      <th>Dificultad promedio</th>";
        echo "      <th>Volverial a elegirlo</th>";
        echo "      <th>Ver</th>";
        echo "  </tr>";
        while($row = mysqli_fetch_array($result)){
            $nombre = $row[0];
            $apellios = $row[1];
            $cal_prom = $row[2];
            $dif_prom = $row[3];
            $volver_elegir = $row[4];
            $id_maestro = $row[5];
            $url = "ver_maestro.php?id_maestro=$id_maestro&id_escuela=$id_escuela";
            echo "  <tr>";
            echo "      <td>$nombre $apellios</th>";
            echo "      <td>$cal_prom</th>";
            echo "      <td>$dif_prom</th>";
            echo "      <td>$volver_elegir%</th>";
            echo "      <td> <a href = $url>Ver</a> </th>";
            echo "  </tr>";

        }
        echo "</table>";
        echo "¿No encuentras a tu maestro?<a href = \"agregar_maestro.php?id_escuela=$id_escuela\"> Haz click aqui</a>";
        mysqli_close($conn);
    ?>
</body>
</html>