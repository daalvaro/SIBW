<?php
    include_once("./scripts/bd.php");
    
    require_once "./vendor/autoload.php";

    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);

    if(!isset($_SESSION)){ 
      session_start();
    }

    // Cambiar los permisos del usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
      $idUsuario = $_POST['idUsuario'];
      $rol = $_POST['rol'];

      actualizarPermisos($idUsuario, $rol);
    }

    $variables = [];

    // Obtener el usuario que ha iniciado sesion
    if(isset($_SESSION['nickUsuario'])){
      $variables['usuario'] = getUsuario($_SESSION['nickUsuario']);
    }

    // Obtener todos los usuarios registrados
    $variables['usuarios'] = getAllUsuarios();

    echo $twig->render('permisos.html', $variables);
?>