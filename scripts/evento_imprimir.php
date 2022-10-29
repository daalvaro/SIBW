<?php
  include_once("./scripts/bd.php");
    
  $resto = substr($uri, 10); // 9 caracteres
  $idEv = intval($resto);

  $conexion_mysql = conectar();

  // Obtener el evento
  $evento = getEvento($idEv, $conexion_mysql);  
  // Obtener las imagenes asociadas al evento
  $imagenes = getImagen($idEv, $conexion_mysql);
    
  echo $twig->render('evento_imprimir.html', ['evento' => $evento, 'imagenes' => $imagenes]);
?>