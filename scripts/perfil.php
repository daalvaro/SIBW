<?php
    include_once("./scripts/bd.php");
    
    $resto = substr($uri, 8); 

    $idUsuario = strval($resto);

    if(!isset($_SESSION)){ 
      session_start(); 
    }
    
    $usuario = [];
    // Obtener el usuario que ha iniciado sesion
    if(isset($_SESSION['nickUsuario'])){
      $usuario = getUsuario($_SESSION['nickUsuario']);
    }

    echo $twig->render('perfil.html', ['usuario' => $usuario]);
?>