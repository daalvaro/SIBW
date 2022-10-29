<?php
  require_once "./vendor/autoload.php";
  include_once("./scripts/bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  function startsWith($string, $query){
    return substr($string, 0, strlen($query)) == $query;
  }

  $uri = $_SERVER['REQUEST_URI'];
  $variables = [];

  session_start();

  // Obtener el usuario que ha iniciado sesion
  if(isset($_SESSION['nickUsuario'])){
    $variables['usuario'] = getUsuario($_SESSION['nickUsuario']);
  }

  // Obtener todos los eventos
  $variables['eventos'] = getAllEventos();
    
  if(startsWith($uri, "/evento")){
    include("scripts/evento.php");
  } else if(startsWith($uri, "/imprimir")){
    include("scripts/evento_imprimir.php");
  } else if(startsWith($uri, "/usuario")){
    include("scripts/perfil.php");
  } else if(startsWith($uri, "/comentarios")){
    include("scripts/comentarios.php");
  } else if(startsWith($uri, "/listaEventos")){
    include("scripts/listaEvento.php");
  } else if(startsWith($uri, "/permisos")){
    include("permisosUsuarios.php");
  } else {    
    $_SESSION['url'] = 'portada.html';
    echo $twig->render($_SESSION['url'], $variables);
  }
?>