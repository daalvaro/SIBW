<?php
    include_once("bd.php");

    session_start();

    // Añadir un nuevo comentario en un evento
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $idEv = $_SESSION['idEvento'];

        $comentario = $_POST['comentario'];

        nuevoComentario($idEv, $comentario);
        header("Location: ../evento/$idEv");
    }
?>