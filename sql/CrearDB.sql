/* Tabla con la informacion de los eventos */
CREATE TABLE eventos(
	id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    titulo VARCHAR(200),
    lugar VARCHAR(200),
    fecha DATE,
    descripcion VARCHAR(8000),
	portada VARCHAR(200),
	publicado BOOLEAN NOT NULL);

/* Tabla con los datos de los comentarios */
CREATE TABLE comentarios(
    autor VARCHAR(15),
    correo VARCHAR(40),
    fecha DATE,
    hora TIME,
    idEvento INT,
	idComentario INT AUTO_INCREMENT PRIMARY KEY,
    comentario VARCHAR(500),
	editado BOOLEAN,
    FOREIGN KEY (idEvento) REFERENCES eventos(id));

/* Tabla con las palabras prohibidas */
CREATE TABLE palabrasprohibidas(
	palabra VARCHAR(20) PRIMARY KEY);

/* Tabla con las imagenes */
CREATE TABLE imagenes(
    idImagen INT,
    idEvento INT NOT NULL,
    imagen VARCHAR(200),
    descripcion VARCHAR(100),
    PRIMARY KEY (idImagen, idEvento),
    FOREIGN KEY (idEvento) REFERENCES eventos(id));

/* Tabla con los usuarios */
CREATE TABLE usuarios(
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    pass VARCHAR(100) NOT NULL,
    correo VARCHAR(40) NOT NULL,
    rol VARCHAR(10) NOT NULL);

/* Tabla con las etiquetas*/
CREATE TABLE etiquetas(
    idEvento INT NOT NULL,
    etiqueta VARCHAR(50),
    PRIMARY KEY (idEvento, etiqueta),
    FOREIGN KEY (idEvento) REFERENCES eventos(id));

