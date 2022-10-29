<?php
    include_once("bd.php");

    // Registrar usuario
    if ($_POST['contraseña'] == $_POST['contraseña-confirm']){
        $correo = $_POST['email'];

        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){ 
            $nick = $_POST['nick'];
            $pass = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

            registrarUsuario($nick, $pass, $correo);  
        } 
    }

    header("Location: ../index.php");
?>