<?php

function verificar(){
    session_start();
    if(isset($_SESSION["nivel_usuario"])){
        $nivel = $_SESSION["nivel_usuario"];
        if($nivel != 1){
            echo "<script>";
            echo "alert(\"¡Necesitas ser un administrador para estar aqui!\");\n";
            echo "window.location.href = \"log_in.php\"";
            echo "</script>";
        } 
    } else{
        echo "<script>";
        echo "alert(\"¡Necesitas registrarte!\");\n";
        echo "window.location.href = \"log_in.php\"";
        echo "</script>";
    }
}




?>