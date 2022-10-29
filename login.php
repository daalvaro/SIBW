<?php
    include("./scripts/bd.php");

    // Login
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $nick = $_POST['nick'];
        $pass = $_POST['contraseña'];

        $id = checkLogin($nick, $pass);
        // Comprobar si el usuario y la contraseña concuerdan
        if($id != -1){
            session_start();

            $_SESSION['id'] = $id;
            $_SESSION['nickUsuario'] = $nick;
        }
    }

    header("Location: index.php");
?>