<?php
    /*function consultarEvento($nombre){
        $conexion = new mysqli("localhost", "alvaro", "pass", "SIBW");

        if(isset($nombre)){
            $consulta = "SELECT * FROM eventos WHERE titulo LIKE '%$nombre%'";

            $respuesta = mysqli_query($conexion, $consulta);

            $salida = '<ul class="list-unstyled">';

            if(mysqli_num_rows($respuesta) > 0){
                while($fila = mysqli_fetch_array($respuesta)){
                    //$salida .= '<li>' . '<a href= evento/' . $fila['id'] . '>' . $fila['titulo'] . '</a>' . '</li>';
                    $salida .= '<a href=evento/' . $fila['id'] . '>' . '<li>' . $fila['titulo'] . '</li>' . '</a>';
                }
            } else {
                $salida .= "<li> Evento no encontrado </li>";
            }
        }

        $salida .= "</ul>";
        echo $salida;
    }

    // Cuando se haga el post
    if(isset($_POST['consulta'])){
        consultarEvento($_POST['consulta']);
    }*/

    function consultarEvento($nombre){
        $conexion = new mysqli("localhost", "alvaro", "pass", "SIBW");

        if(isset($nombre)){
            $consulta = "SELECT * FROM eventos WHERE titulo LIKE '%$nombre%'";

            $respuesta = mysqli_query($conexion, $consulta);

            $salida = '<ul class="list-unstyled">';

            if(mysqli_num_rows($respuesta) > 0){
                while($fila = mysqli_fetch_array($respuesta)){
                    //$salida .= '<li>' . '<a href= evento/' . $fila['id'] . '>' . $fila['titulo'] . '</a>' . '</li>';
                    $salida .= '<a href=evento/' . $fila['id'] . '>' . '<li>' . $fila['titulo'] . '</li>' . '</a>';
                }
            } else {
                $salida .= "<li> Evento no encontrado </li>";
            }
        }

        $salida .= "</ul>";
        echo $salida;
    }
?>