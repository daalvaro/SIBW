<?php
    include_once("bd.php");

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        if(isset($_POST['user'])){      // Modificar el nombre de usuario
            $newnick = $_POST['user'];
            actualizarUsuario($_SESSION['id'], $newnick, 'cambiarnombre');

        } else if(isset($_POST['correo'])){     // Modificar el correo
            $newmail = $_POST['correo'];

            // Comprobar si se ha introducido un correo con el formato correcto
            if(filter_var($newmail, FILTER_VALIDATE_EMAIL)){    
                actualizarUsuario($_SESSION['id'], $newmail, 'cambiarmail');
            }

        } else if(isset($_POST['passwd'])){     // Modificar la contraseña
            if ($_POST['passwd'] == $_POST['new-passwd']){
                $newpass = password_hash($_POST['passwd'], PASSWORD_DEFAULT);
                actualizarUsuario($_SESSION['id'], $newpass, 'cambiarpass');
            }
        }

        $us = $_SESSION['nickUsuario'];

        header("Location: ../usuario/$us");
    }
?>