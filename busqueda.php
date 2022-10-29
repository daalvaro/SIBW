<?php
    // Mostrar los eventos que han resultado de la búsqueda
    function consultarEvento($nombre){
        require_once "./vendor/autoload.php";
        include_once("./scripts/bd.php");

        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader);

        session_start();

        $conexion_mysql = conectar();

        if(isset($nombre)){            
            if (isset($_SESSION['id'])){
                $idUsuario = $_SESSION['id'];
                // Obtener el rol del usuario
                $busqueda = $conexion_mysql->query("SELECT rol FROM usuarios WHERE idUsuario='$idUsuario'");
            
                if($busqueda->num_rows > 0){
                    $rol = $busqueda->fetch_assoc();      
                }

                // Si el rol es super / gestor, puede ver todo los eventos
                if($rol['rol'] == 'super' || $rol['rol'] == 'gestor'){
                    $resultado = $conexion_mysql->query("SELECT * FROM eventos WHERE titulo LIKE '%$nombre%'");
                } else {
                    $resultado = $conexion_mysql->query("SELECT * FROM eventos WHERE titulo LIKE '%$nombre%' AND publicado=1");
                }
            } else {
                $resultado = $conexion_mysql->query("SELECT * FROM eventos WHERE titulo LIKE '%$nombre%' AND publicado=1");
            }

            $lista = [];

            if($resultado->num_rows > 0){
                while($fila = mysqli_fetch_array($resultado)){
                    array_push($lista, $fila);
                }
            } 
        }

        // Mostar la lista de eventos buscados
        echo $twig->render('lista.html', ['lista' => $lista]);
    }

    if(isset($_POST['consulta'])){
        consultarEvento($_POST['consulta']);
    }
?>