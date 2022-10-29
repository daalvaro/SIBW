<?php
    include_once("bd.php");

    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['eliminarEvento'])){       // Eliminar un evento
            $idEvento = $_POST['idEvento'];
            
            eliminarEvento($idEvento);
            $_SESSION['eventos'] = getAllEventos();

        } else if(isset($_POST['addEtiqueta'])) {  // Añadir una etiqueta a un evento
            $idEvento = $_POST['idEvento'];
            $etiqueta = $_POST['etiqueta'];

            addEtiqueta($idEvento, $etiqueta);
            $_SESSION['eventos'] = getAllEventos();

        } else if (isset($_POST['search'])){       // Realizar la búsqueda de texto en los eventos
            $search = $_POST['search'];
            $eventos = buscarEventos($search);
            $_SESSION['eventos'] = $eventos;
            $_SESSION['busquedaEventos'] = 1;

        } else if(isset($_FILES['imagen'])){    // Añadir una imagen a un evento
            
            $errors = array();
          
            $idEvento = $_POST['idEvento'];
            $descripcion = $_POST['infoImagen'];
          
            $file_name = $_FILES['imagen']['name'];
            $file_size = $_FILES['imagen']['size'];
            $file_tmp = $_FILES['imagen']['tmp_name'];
            $file_type = $_FILES['imagen']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['imagen']['name'])));
                
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
                subirImagen($idEvento, $imagen, $descripcion);
            }  
            
        } else if(isset($_POST['modificarEvento'])){    // Modificar los datos de un evento
            $idEvento = $_POST['idEvento'];
            $titulo = $_POST['titulo'];
            $organizador = $_POST['organizador'];
            $fecha = $_POST['fecha'];
            $descripcion = $_POST['descripcion'];

            editarEvento($idEvento, $titulo, $organizador, $fecha, $descripcion);  
            $_SESSION['eventos'] = getAllEventos();
              
        } else if(isset($_POST['publicado'])){
            $idEvento = $_POST['idEvento'];
            $publicado = $_POST['valor'];

            editarPublicado($idEvento, $publicado);
            $_SESSION['eventos'] = getAllEventos();  
        }
    }

    $url =  $_SESSION['url'];
    header("Location: $url");
?>