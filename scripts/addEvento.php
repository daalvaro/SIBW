<?php
    include_once("bd.php");

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        $titulo = $_POST['titulo'];
        $organizador = $_POST['organizador'];
        $fecha = $_POST['fecha'];
        $descripcion = $_POST['descripcion'];

        if(isset($_FILES['portada'])){
            $errors = array();

            $file_name = $_FILES['portada']['name'];
            $file_size = $_FILES['portada']['size'];
            $file_tmp = $_FILES['portada']['tmp_name'];
            $file_type = $_FILES['portada']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['portada']['name'])));
                
            $extensions= array("jpeg","jpg","png");
                
            if (in_array($file_ext,$extensions) === false){
                $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
                
            if ($file_size > 2097152){
                $errors[] = 'Tamaño del fichero demasiado grande';
            }
                
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "../img/" . $file_name);
                  
                $imagen = "../img/" . $file_name;
            }
                
            if (sizeof($errors) > 0) {
                echo "Error";
            }
        } 

        addEvento($titulo, $organizador, $fecha, $descripcion, $imagen);
        $_SESSION['eventos'] = getAllEventos();
    }

    header("Location: ../listaEventos");

    exit;
?>