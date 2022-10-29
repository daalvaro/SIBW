<?php
    // Conectarse a la BD
    function conectar(){
        $conexion_mysql = new mysqli("localhost", "alvaro", "pass", "SIBW");

        if($conexion_mysql->connect_errno){
            echo("Fallo en la conexión" . $conexion_mysql->connect_errn);
        }

        $conexion_mysql->set_charset("utf8");

        return $conexion_mysql;
    }

    /************************************************************************************************************************************************/
    // Comentarios
    /************************************************************************************************************************************************/

    // Obtener un evento
    function getEvento($idEv, $conexion_mysql){
        $evento = array('titulo' => 'A', 'lugar' => 'B', 'fecha' => 'C', 'descripcion' => 'D', 'fechaFormato'=> 'E', 'etiquetas', 'id');

        $resultado = $conexion_mysql->query("SELECT id, titulo, lugar, fecha, descripcion FROM eventos WHERE id=" . $idEv);

        $etiquetas = getEtiquetas($idEv, $conexion_mysql);

        if ($resultado->num_rows > 0){
			$fila = $resultado->fetch_assoc();

			$evento['titulo'] = $fila['titulo'];
			$evento['lugar'] = $fila['lugar'];

            // Dar formato a la hora
            $date = strtotime($fila['fecha']);
            setlocale(LC_ALL, "es_ES.utf8");
            $evento['fecha'] = strftime('%e de %B, %G', $date);

            $evento['fechaFormato'] = $fila['fecha'];
            
            // Formato del texto
            $text = nl2br($fila['descripcion']);
            $evento['descripcion'] = str_replace('<br />', "\n", $text);

            $evento['id'] = $fila['id'];
		}

        // Etiquetas del evento
        $evento['etiquetas'] = $etiquetas;

		return $evento;
    }

    // Obtener todos los eventos
    function getAllEventos(){
        $conexion_mysql = conectar();

        $eventos = [];

        if (isset($_SESSION['id'])){
            $idUsuario = $_SESSION['id'];
            // Obtener el rol del usuario
            $busqueda = $conexion_mysql->query("SELECT rol FROM usuarios WHERE idUsuario='$idUsuario'");
        
            if($busqueda->num_rows > 0){
                $rol = $busqueda->fetch_assoc();      
            }

            // Si el rol es super / gestor, puede ver todo los eventos
            if($rol['rol'] == 'super' || $rol['rol'] == 'gestor'){
                $resultado = $conexion_mysql->query("SELECT * FROM eventos");
            } else {
                $resultado = $conexion_mysql->query("SELECT * FROM eventos WHERE publicado=1");
            }
        } else {
            $resultado = $conexion_mysql->query("SELECT * FROM eventos WHERE publicado=1");
        }

        $contador = 0;

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $eventos[$contador]['titulo'] = $fila['titulo'];
                $eventos[$contador]['lugar'] = $fila['lugar'];
                $eventos[$contador]['fecha'] = $fila['fecha'];
                $eventos[$contador]['descripcion'] = $fila['descripcion'];
                $eventos[$contador]['portada'] = $fila['portada'];
                $eventos[$contador]['id'] = $fila['id'];
                $eventos[$contador]['publicado'] = $fila['publicado'];

                $etiquetas = getEtiquetas($fila['id'], $conexion_mysql);

                $eventos[$contador]['etiquetas'] = $etiquetas;
                $contador++;
            }
        }

        return $eventos;
    }

    // Añadir un evento
    function addEvento($titulo, $organizador, $fecha, $descripcion, $imagen){
        $conexion_mysql = conectar();

        $conexion_mysql->query("INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada) VALUES('$titulo', '$organizador', '$fecha', '$descripcion', '$imagen')");
    }

    // Editar la informacion de un evento
    function editarEvento($idEvento, $titulo, $organizador, $fecha, $descripcion){
        $conexion_mysql = conectar();

        $conexion_mysql->query("UPDATE eventos SET titulo='$titulo', lugar='$organizador', fecha='$fecha', descripcion='$descripcion' WHERE id='$idEvento'");
    }

    function editarPublicado($idEvento, $publicado){
        $conexion_mysql = conectar();

        if ($publicado == 'Si'){
            $conexion_mysql->query("UPDATE eventos SET publicado=1 WHERE id='$idEvento'");
        } else {
            $conexion_mysql->query("UPDATE eventos SET publicado=0 WHERE id='$idEvento'");
        }
    }

    // Eliminar un evento
    function eliminarEvento($idEvento){
        $conexion_mysql = conectar();
        $conexion_mysql->query("DELETE FROM etiquetas WHERE idEvento='$idEvento'");
        $conexion_mysql->query("DELETE FROM imagenes WHERE idEvento='$idEvento'");
        $conexion_mysql->query("DELETE FROM comentarios WHERE idEvento='$idEvento'");
        $conexion_mysql->query("DELETE FROM eventos WHERE id='$idEvento'");
    }

    // Añadir una etiqueta a un evento
    function addEtiqueta($idEvento, $etiqueta){
        $conexion_mysql = conectar();

        $conexion_mysql->query("INSERT INTO etiquetas VALUES('$idEvento', '$etiqueta')");
    }

    // Buscar los eventos dado un texto de entrada
    function buscarEventos($search){
        $conexion_mysql = conectar();

        $resultado = $conexion_mysql->query("SELECT * from eventos WHERE descripcion LIKE '%$search%'");

        $contador = 0;

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $eventos[] = $fila;

                $etiquetas = getEtiquetas($fila['id'], $conexion_mysql);

                $eventos[$contador]['etiquetas'] = $etiquetas;
                $contador++;
            }
        } 

        return $eventos;
    }

    // Subir una imagen a un evento
    function subirImagen($idEvento, $imagen, $descripcion){
        $conexion_mysql = conectar();

        $resultado = $conexion_mysql->query("SELECT IdImagen FROM imagenes WHERE idEvento='$idEvento'");

        if ($resultado->num_rows == 0){
            $idImagen = 1;
        } else {
            $idImagen = $resultado->num_rows + 1;
        }
        
        $conexion_mysql->query("INSERT INTO imagenes VALUES('$idImagen', '$idEvento', '$imagen', '$descripcion')");
    }

    /************************************************************************************************************************************************/
    // Comentarios
    /************************************************************************************************************************************************/

    // Obtener los comentarios de un evento
    function getComentarios($idEv, $conexion_mysql){
        $comentarios = [];

        $resultado = $conexion_mysql->query("SELECT autor, correo, fecha, hora, comentario, idComentario FROM comentarios WHERE idEvento=" . $idEv);

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $comentarios[] = $fila;
            }
        }

        return $comentarios;
    }

    // Obtener todos los comentarios
    function getAllComentarios(){
        $conexion_mysql = conectar();
        $comentarios = [];

        $resultado = $conexion_mysql->query("SELECT * FROM comentarios ORDER BY idEvento");

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $comentarios[] = $fila;
            }
        }

        return $comentarios;
    }

    // Añadir un nuevo comentario
    function nuevoComentario($idEv, $comentario){
        $conexion_mysql = conectar();
        $nick = $_SESSION['nickUsuario'];

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $id = $idEv;

        $resultado = $conexion_mysql->query("SELECT correo FROM usuarios where nombre='$nick'");

        $fila = $resultado->fetch_assoc();
        $correo = $fila['correo'];

        $conexion_mysql->query("INSERT INTO comentarios(autor, correo, fecha, hora, idEvento, comentario, editado) VALUES('$nick', '$correo', '$fecha', '$hora', '$id', '$comentario', false)");
    }

    // Buscar comentarios dado un texto de entrada
    function buscarComentarios($search){
        $conexion_mysql = conectar();

        $resultado = $conexion_mysql->query("SELECT * from comentarios WHERE comentario LIKE '%$search%'");

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $comentarios[] = $fila;
            }
        } 

        return $comentarios;
    }

    // Eliminar un comentario
    function eliminarComentario($id){
        $conexion_mysql = conectar();

        $conexion_mysql->query("DELETE FROM comentarios WHERE idComentario='$id'");
    }

    // Modificar el texto de un comentario. Sólo se puede editar el comentario una vez
    function modificarComentario($id, $comentario){
        $conexion_mysql = conectar();

        $resultado = $conexion_mysql->query("SELECT editado FROM comentarios WHERE idComentario='$id'");
        $fila = $resultado->fetch_assoc();

        if($fila['editado'] == 0){
            $comentario = $comentario . " (editado por moderador)";
            $conexion_mysql->query("UPDATE comentarios SET editado=true WHERE idComentario='$id'");
            $conexion_mysql->query("UPDATE comentarios SET comentario='$comentario' WHERE idComentario='$id'");
        }
    }

    /************************************************************************************************************************************************/
    // Datos eventos
    /************************************************************************************************************************************************/
    
    // Obtener las imagenes asociadas a un evento
    function getImagen($idEv, $conexion_mysql){
        $imagenes = [];

        $resultado = $conexion_mysql->query("SELECT idImagen, imagen, descripcion FROM imagenes WHERE idEvento=" . $idEv);

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $imagenes[] = $fila;
            }
        }

        return $imagenes;
    }
    
    // Obtener las palabras prohibidas
    function getPalabrasProhibidas($conexion_mysql){
        $prohibidas = [];

        $resultado = $conexion_mysql->query("SELECT palabra FROM palabrasprohibidas");

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $prohibidas[] = $fila['palabra'];
            }
        }

        return $prohibidas;
    }

    // Obtener las etiquetas asociadas a un evento
    function getEtiquetas($idEv, $conexion_mysql){
        $etiquetas = [];

        $resultado = $conexion_mysql->query("SELECT etiqueta FROM etiquetas WHERE idEvento='$idEv'");

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $etiquetas[] = $fila['etiqueta'];
            }
        }

        return $etiquetas;
    }

    /************************************************************************************* */
    // Login
    /************************************************************************************* */
    
    // Comprobar si el login es correcto
    function checkLogin($nick, $pass){
        $conexion_mysql = conectar();

        $resultado = $conexion_mysql->query("SELECT idUsuario, nombre, pass, correo, rol FROM usuarios WHERE nombre ='$nick'");

        if($resultado->num_rows > 0){
            $fila = $resultado->fetch_assoc();

            if(password_verify($pass, $fila['pass'])){
                $_SESSION['id'] = $fila['idUsuario'];
                return $_SESSION['id'];
            }
        } 

        return -1;
    }

    /************************************************************************************* */
    // Usuarios
    /************************************************************************************* */

    // Obtener un usuario
    function getUsuario($nick){
        $conexion_mysql = conectar();
        $usuario = array('idUsuario', 'nombre', 'pass', 'correo', 'rol');

        $resultado = $conexion_mysql->query("SELECT * FROM usuarios WHERE nombre='$nick'");
        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $usuario['idUsuario'] = $fila['idUsuario'];
                $usuario['nombre'] = $fila['nombre'];
                $usuario['pass'] = $fila['pass'];
                $usuario['correo'] = $fila['correo'];
                $usuario['rol'] = $fila['rol'];
            }
        } 

        $conexion_mysql->close();
        return $usuario;
    }

    // Obtener todos los usuarios
    function getAllUsuarios(){
        $conexion_mysql = conectar();
        $usuarios = [];
        
        $idSuper = $_SESSION['id'];
        $resultado = $conexion_mysql->query("SELECT * FROM usuarios WHERE idUsuario<>'$idSuper'");

        if ($resultado->num_rows > 0){
            while($fila = $resultado->fetch_assoc()){
                $usuarios[] = $fila;
            }
        }

        return $usuarios;
    }

    // Registrar un usuario
    function registrarUsuario($nick, $pass, $correo){
        $conexion_mysql = conectar();

        $conexion_mysql->query("INSERT INTO usuarios(nombre, pass, correo, rol) VALUES('$nick', '$pass', '$correo', 'registrado')");
    }

    // Actualizar los datos de un usuario
    function actualizarUsuario($id, $valor, $opcion){
        $conexion_mysql = conectar();

        if($opcion == 'cambiarnombre'){
            $conexion_mysql->query("UPDATE usuarios SET nombre='$valor' WHERE idUsuario='$id'");
            $_SESSION['nickUsuario'] = $valor;
        } else if($opcion == 'cambiarmail'){
            $conexion_mysql->query("UPDATE usuarios SET correo='$valor' WHERE idUsuario='$id'");
            
        } else if($opcion == 'cambiarpass'){
            $conexion_mysql->query("UPDATE usuarios SET pass='$valor' WHERE idUsuario='$id'");
        }

    }

    // Actualizar los permisos de un usuario
    function actualizarPermisos($idUsuario, $rol){
        $conexion_mysql = conectar();

        $conexion_mysql->query("UPDATE usuarios SET rol='$rol' WHERE idUsuario='$idUsuario'");
    }
?>
