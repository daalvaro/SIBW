<?php
    include_once("bd.php");
    
    if(!isset($_SESSION)){ 
      session_start();
    }
    
    $resto = substr($uri, 8); 
    $idEv = intval($resto);

    $conexion_mysql = conectar();

    // Obtener el evento
    $evento = getEvento($idEv, $conexion_mysql);  
    // Obtener las imagenes asociadas al evento
    $imagenes = getImagen($idEv, $conexion_mysql);
    // Obtener la lista de palabras prohibidas
    $prohibidas = getPalabrasProhibidas($conexion_mysql);
    
    $usuario = [];

    // Obtener el usuario que ha iniciado sesion
    if(isset($_SESSION['nickUsuario'])){
      $usuario = getUsuario($_SESSION['nickUsuario']);
    }

    // Obtener el id del evento actual
    $_SESSION['idEvento'] = $idEv;
    // Obtener la url del evento actual
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    
    // Obtener los comentarios asociados al evento
    $comentarios = getComentarios($idEv, $conexion_mysql);

    echo $twig->render('evento.html', ['evento' => $evento, 'comentarios' => $comentarios, 'imagenes' => $imagenes, 
                                       'prohibidas' => $prohibidas, 'usuario' => $usuario, 'id' => $idEv]);
?>