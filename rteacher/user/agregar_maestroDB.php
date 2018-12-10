<?php
   
         //Agregar el maestro a la DB
        include "../DBConfig.php";
        $nombre = $_POST["nombre2"];
        $apellidos = $_POST["apellidos2"];
        $id_escuela = $_GET["id_escuela"];
        $conn = getMySQLi();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            exit;
        } 
        $sql = "INSERT INTO maestro (id_escuela,Nombre,Apellidos) VALUES ($id_escuela,'$nombre','$apellidos');";
        echo $sql;

        if ($conn->query($sql) === TRUE) {
            $id_maestro = $conn->insert_id;
            header("Location: ver_maestro.php?id_maestro=$id_maestro&id_escuela=$id_escuela");
	    } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            exit;
        }
        $conn->close();
    
   
?>  