<?php
    include_once("bd.php");

    if(!isset($_SESSION)){ 
        session_start();  
    }

    // La primera vez, no se ha realizado una búsqueda, por lo tanto se muestran todos los eventos 
    if(!isset($_SESSION['busquedaEventos'])){
        $_SESSION['busquedaEventos'] = 0;
    }
          
    // Comprobar si se ha realizado una búsqueda
    if($_SESSION['busquedaEventos'] == 0){
        $eventos = getAllEventos();
    } else {
        $eventos = $_SESSION['eventos'];
    }

    // Obtener el usuario que ha iniciado sesion
    if(isset($_SESSION['nickUsuario'])){
        $usuario = getUsuario($_SESSION['nickUsuario']);
    }

    // Obtener la url de la página de lista de comentarios
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];

    echo $twig->render('listaEventos.html', ['usuario' => $usuario, 'eventos' => $eventos]);
?>