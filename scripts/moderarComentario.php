<?php
    include_once("bd.php");

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if (isset($_POST['idComentarioEliminar'])){     // Eliminar un comentario
            $idComentario = $_POST['idComentarioEliminar'];
            eliminarComentario($idComentario);
            $_SESSION['comentarios'] = getAllComentarios();
            
        } else if (isset($_POST['search'])){            // Buscar un comentario           
            $search = $_POST['search'];
            $comentarios = buscarComentarios($search);
            $_SESSION['comentarios'] = $comentarios;
            $_SESSION['busquedaComentario'] = 1;

        } else {    // Editar un comentario
            $idComentario = $_POST['idComentarioEditar'];
            $comentario = $_POST['comentario'];

            modificarComentario($idComentario, $comentario);
            $_SESSION['comentarios'] = getAllComentarios();
        }
    }

    $url =  $_SESSION['url'];
    header("Location: $url");
?>