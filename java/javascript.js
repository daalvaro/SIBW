// Variable que controla si se abre/cierra el menu de comentario
var open = false;
var x = window.matchMedia("(max-width: 968px)");

// Funcion que abre el menu de comentarios
function openNav() {
    document.getElementById("contenido").style.width = "50%";
    document.getElementById('sidenav').style.width = "20%";
    document.getElementById("myNav").style.width = "29%";
    document.getElementById("myNav").style.height = "100%";

    open = true;
}

// Funcion que cierra el menu de comentarios
function closeNav() {
    document.getElementById("myNav").style.width = "0";
    document.getElementById("myNav").style.height = "0";
    document.getElementById("contenido").style.width = "70%";
    document.getElementById('sidenav').style.width = "30%";

    open = false;
}

// Redimensionar la pagina para dispositivos con pantallas mas pequeñas
function redimensionar(x) {
    if (open) {
        if (x.matches) {
            document.getElementById("myNav").style.width = "100%";
            document.getElementById("myNav").style.height = "100%";
            document.getElementById("contenido").style.width = "100%";
            document.getElementById('sidenav').style.width = "100%";
        } else {
            openNav();
        }
    }
}

// Variables globales con información de los campos del formulario
var nombre = document.getElementById("comment-author");
var correo = document.getElementById("comment-mail");
var comentario = document.getElementById("comment");

// Añadir un comentario al menu
function addComment() {
    // Expresion regular para comprobar el formato del correo
    var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,18}$/;
    var correcto = true;

    if (nombre.value == "") {
        mostrarError(nombre, "error-author", "El nombre no puede estar vacío");
        correcto = false;
    } else {
        success(nombre, "error-author");
    }

    comprobarCorreo();

    if (comentario.value == "") {
        mostrarError(comentario, "error-comment", "El comentario no puede estar vacío");
        correcto = false;
    } else {
        success(comentario, "error-comment");
    }

    if (correcto) {
        newComment();
    }
}

function comprobarCorreo(){
    var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,18}$/;
    var correcto = true;

    if (correo.value == "") {
        mostrarError(correo, "error-email", "El correo no puede estar vacío");
        correcto = false;
    } else if (!re.test(correo.value)) {
        mostrarError(correo, "error-email", "El correo introducido no tiene un formato correcto");
        correcto = false;
    } else {
        success(correo, "error-email");
        document.getElementById('form-correo').style.display = 'none';
        document.getElementById('editar-correo').style.visibility = 'visible';
    }
}

// Si un campo está vacío o contiene información erronéa, muestra un mensaje de error
function mostrarError(variable, element, message) {
    variable.style.border = "2px solid red";
    document.getElementById(element).innerHTML = message;
    document.getElementById(element).style.visibility = "visible";
}

// El dato introducido es correcto
function success(variable, element) {
    variable.style.border = "2px solid green";
    document.getElementById(element).style.visibility = "hidden";
}

// Filtro de palabras prohibidas
function filter(prohibidas) {
    var filtro = "";

    //Lista con las palabras prohibidas
    const badWordsRegex = new RegExp(prohibidas.join("|"), 'gi');
    var str = document.getElementById("comment").value;

    filtro = str.replace(badWordsRegex, badWord => "*".repeat(badWord.length));
    document.getElementById("comment").value = filtro;
}

// Filtro de palabras prohibidas para un evento específico
function filterComentario(prohibidas, id) {
    var filtro = "";

    //Lista con las palabras prohibidas
    const badWordsRegex = new RegExp(prohibidas.join("|"), 'gi');
    var str = document.getElementsByClassName('comment')[id].value;

    filtro = str.replace(badWordsRegex, badWord => "*".repeat(badWord.length));
    document.getElementsByClassName('comment')[id].value = filtro;
}

/******************************************************************************************************/
// Eventos
/******************************************************************************************************/
// Abrir formulario de modificación de evento
function abrirEdicionComentario(contador){
    document.getElementsByClassName('formulario-modificar-evento')[contador].style.display = 'block';
}

function abrirEdicionEvento(){
    document.getElementById('formulario-modificar-evento').style.display = 'block';
}

// Cerrar formulario de modificación de evento
function cerrarEdicionComentario(id){
    document.getElementsByClassName('formulario-modificar-evento')[id].style.display = 'none';
}

function cerrarEdicionEvento(){
    document.getElementById('formulario-modificar-evento').style.display = 'none';
}

// Abrir formulario de añadir etiqueta
function abrirFormEtiqueta(contador){
    document.getElementsByClassName('formulario-add-etiqueta')[contador].style.display = 'block';
}

// Cerrar formulario de añadir etiqueta
function cerrarFormEtiqueta(id){
    document.getElementsByClassName('formulario-add-etiqueta')[id].style.display = 'none';
}

// Abrir formulario de añadir comentario
function abrirAñadirComentario(){
    document.getElementById('formulario-add-evento').style.display = 'block';
}

// Cerrar formulario de añadir comentario
function cerrarAñadirComentario(){
    document.getElementById('formulario-add-evento').style.display = 'none';
}

/******************************************************************************************************/
// Comentarios
/******************************************************************************************************/

// Abrir formulario para la edición de un comentario
function abrirEditar(contador){
    document.getElementsByClassName('formulario-editar-comentario')[contador].style.display = 'block';
}

// Cerrar formulario para la edición de un comentario
function cerrarEditar(id){
    document.getElementsByClassName('formulario-editar-comentario')[id].style.display = 'none';
}


/******************************************************************************************************/
// Perfil
/******************************************************************************************************/
// Abrir formulario de modificación de nombre de usuario
function abrirFormularioUser(){
    document.getElementById('form-user').style.display = 'block';
    document.getElementById('editar-user').style.visibility = 'hidden';
}

// Cerrar formulario de modificación de nombre de usuario
function cerrarFormularioUser(){
    document.getElementById('form-user').style.display = 'none';
    document.getElementById('editar-user').style.visibility = 'visible';
}

// Abrir formulario de modificación de correo
function abrirFormularioCorreo(){
    document.getElementById('form-correo').style.display = 'block';
    document.getElementById('editar-correo').style.visibility = 'hidden';
}

// Cerrar formulario de modificación de nombre de correo
function cerrarFormularioCorreo(){
    document.getElementById('form-correo').style.display = 'none';
    document.getElementById('editar-correo').style.visibility = 'visible';
}

// Abrir formulario de modificación de contraseña
function abrirFormularioPass(){
    document.getElementById('form-pass').style.display = 'flex';
    document.getElementById('editar-pass').style.visibility = 'hidden';
}

// Cerrar formulario de modificación de contraseña
function cerrarFormularioPass(){
    document.getElementById('form-pass').style.display = 'none';
    document.getElementById('editar-pass').style.visibility = 'visible';
}

/******************************************************************************************************/
// Login / SignUp
/******************************************************************************************************/
// Mostrar el formulario de login
function login(){
    document.getElementById('form-login').style.display = 'block';
}

// Cerrar el formulario de login
function cerrarLogin(){
    document.getElementById('form-login').style.display = 'none';
}

// Mostrar formulario de registro
function signup(){
    document.getElementById('form-signup').style.display = 'block';
}

// Cerrar formulario de registro
function cerrarSignUp(){
    document.getElementById('form-signup').style.display = 'none';
}

/******************************************************************************************************/
// Búsqueda de eventos
/******************************************************************************************************/

// Ocultar los eventos de la lista de búsqueda
function ocultarEventos(){
    $('#listaEventos').fadeOut();
}

// Mostrar los eventos de la lista de búsqueda
function mostrarEventos(datos){
    $('#listaEventos').fadeIn();
    $('#listaEventos').html(datos);
}

// Ejecutar la búsqueda cuando se introduce un texto en la búsqueda
function eventoPulsarTecla(){
    var consulta = $(this).val();

    if(consulta != '' && consulta.length > 1){
        configuracionAJAX = {
            url: "../busqueda.php",
            method: "POST",
            data: {consulta: consulta},
            success: mostrarEventos 
        };

        $.ajax(configuracionAJAX);
    } else {
        ocultarEventos();
    }

    // Cuando hagamos click en los elementos, se ponga el texto en el cuadro
    $(document).on('click', 'li', function() {
        $('#busqueda').val($(this.text()));
        ocultarEventos();
    });
}

function cargarDatos(){
    $('#busqueda').keyup(eventoPulsarTecla);
}

$(document).ready(cargarDatos);

/************************************************************ */
// Cambiar las imagenes de la galeria
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("slide");

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }

    slideIndex++;

    if (slideIndex > slides.length) {
        slideIndex = 1;
    }

    slides[slideIndex - 1].style.display = "block";
    setTimeout(showSlides, 3000);
}

// Cambio en el tamaño de la ventana
redimensionar(x);
x.addEventListener("change", redimensionar);