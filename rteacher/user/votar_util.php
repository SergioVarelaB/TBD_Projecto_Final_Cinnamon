<?php
    session_start();
    $id_escuela = $_GET["id_escuela"];
    if(isset($_SESSION["id_usuario"])){
        $id_escuela_user = $_SESSION["id_escuela"];
        $id_usuario = $_SESSION["id_usuario"];
        if($id_escuela != $id_escuela_user){
            echo "<script>";
            echo "alert(\"¡Solo puedes votar por calificaciones de tu escuela!\");\n";
            echo "window.history.back();";
            echo "</script>";
        }
    } else{
        echo "<script>";
        echo "alert(\"¡Necesitas registrarte votar!\");\n";
        echo "window.location.href = \"log_in.php\"";
        echo "</script>";
    }    
?>

<?php
    $id_calificacion = $_GET["id_cal"];
    $id_maestro = $_GET["id_maestro"];

    /*include "../DBConfig.php";

    //Conexion con la base de datos
    $conn = getConexionUsuario();
    if(mysqli_connect_errno($conn))
    {
        echo 'No se pudo hacer la conexión con la base de datos';
        exit;
    }

    $sql = "INSERT INTO votos VALUES ($id_calificacion,$id_usuario,'UTIL')";
    mysqli_query($conn, $sql);

    header("Location: ver_maestro.php?id_maestro=$id_maestro&id_escuela=$id_escuela");*/

    include "../DBConfig.php";

    $conn = getMySQLi();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        exit;
    } 

    $sql = "INSERT INTO votos VALUES ($id_calificacion,$id_usuario,'UTIL')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ver_maestro.php?id_maestro=$id_maestro&id_escuela=$id_escuela");
    } else{
        echo "<script>";
        echo "alert(\"No puedes votar dos veces por el mismo comenrario\");\n";
        echo "window.history.back();";
        echo "</script>";
        exit;
    }
?>