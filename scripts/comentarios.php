<?php
    include_once("bd.php");

    if(!isset($_SESSION)){ 
      session_start();  
    }  

    $conexion_mysql = conectar();

    // Obtener la lista de palabras prohibidas
    $prohibidas = getPalabrasProhibidas($conexion_mysql);

    // La primera vez, no se ha realizado una búsqueda, por lo tanto se muestran todos los comentarios    
    if(!isset($_SESSION['busquedaComentario'])){
      $_SESSION['busquedaComentario'] = 0;
    }
    
    // Comprobar si se ha realizado una búsqueda
    if($_SESSION['busquedaComentario'] == 0){
      $comentarios = getAllComentarios();
    } else {
      $comentarios = $_SESSION['comentarios'];
    }

    $usuario = [];

    // Obtener el usuario que ha iniciado sesion
    if(isset($_SESSION['nickUsuario'])){
      $usuario = getUsuario($_SESSION['nickUsuario']);
    }

    // Obtener la url de la página de lista de comentarios
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];

    echo $twig->render('comentarios.html', ['usuario' => $usuario, 'comentarios' => $comentarios, 'prohibidas' => $prohibidas]);
?>