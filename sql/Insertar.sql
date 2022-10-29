/* Informacion de los eventos */
INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES ('Exposición super en Berlín: descubre los nuevos estados de la materia', 'Organizado por WCP', '2021-03-21', "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.32. The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from de Finibus Bonorum et Malorum by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).", '../img/superfluido.png', true);


INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES("Exposición Step into Space en el Parque de las Ciencias de Granada", 'Organizado por WCP', '2021-03-27', 'descripcion2', '../img/astronauta.png', true);

INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES('Conferencia sobre mecánica cuántica en la Universidad de Granada', 'Organizado por UGR', '2021-03-29', 'Lorem Ipsum', '../img/cuantica.png', true);

INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES('Taller sobre la fuerza de la gravedad en el Museo de las Ciencias de Valencia', 'Organizado por WCP', '2021-04-03', 'descripcion3', '../img/gravity.png', true);

INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES('¿Vemos todo lo que existe? Conferencia sobre materia oscura en Nueva York', 'Organizado por WCP', '2021-04-04', 'Lorem Ipsum', '../img/materia-oscura.png', true);

INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES('Visita guiada por el Gran Colisionador de Hadrones', 'Organizado por WCP', '2021-04-16', 'Lorem Ipsum', '../img/lhc.png', true);

INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES('Cómo funcionan los paneles solares? Exposición sobre energías renovables en el Parque de las Ciencias de Granada', 'Organizado por WCP', '2021-05-15', 'descripcion4', '../img/paneles.png', true);

INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES('Taller sobre el efecto fotoeléctrico en el Parque de las Ciencias de Granada', 'Organizado por WCP', '2021-05-15', 'descripcion5', '../img/electrico.png', true);

INSERT INTO eventos(titulo, lugar, fecha, descripcion, portada, publicado) VALUES('Directo: Eclipse total lunar', 'Organizado por WCP', '2021-05-26', 'Lorem Ipsum', '../img/luna.png', false);


/* Comentarios predefinidos */
INSERT INTO comentarios(autor, correo, fecha, hora, idEvento, comentario, editado) VALUES('alvaro149', 'alvaro149@correo.ugr.es', '2021-03-21', '19:28', 1, "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.", false);

INSERT INTO comentarios(autor, correo, fecha, hora, idEvento, comentario, editado) VALUES('alvaro149', 'alvaro149@correo.ugr.es', '2021-03-22', '13:24', 1, "It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", false);


/* Palabras prohibidas */
INSERT INTO palabrasprohibidas VALUES ('arma');
INSERT INTO palabrasprohibidas VALUES ('falso');
INSERT INTO palabrasprohibidas VALUES ('gato');
INSERT INTO palabrasprohibidas VALUES ('manzana');
INSERT INTO palabrasprohibidas VALUES ('pera');
INSERT INTO palabrasprohibidas VALUES ('perro');
INSERT INTO palabrasprohibidas VALUES ('platano');
INSERT INTO palabrasprohibidas VALUES ('resta');
INSERT INTO palabrasprohibidas VALUES ('suma');
INSERT INTO palabrasprohibidas VALUES ('tonto');


/* Imagenes */
INSERT INTO imagenes VALUES(1, 1, '../img/inn.png', 'Holiday Inn Berlin City East-Landsberger');
INSERT INTO imagenes VALUES(2, 1, '../img/conductor.png', 'Superconductor');


/* Etiquetas */
INSERT INTO etiquetas VALUES(1, 'etiqueta 1');
INSERT INTO etiquetas VALUES(1, 'etiqueta 2');
INSERT INTO etiquetas VALUES(5, 'etiqueta 3');


/* Usuarios 

Para crear un superusuario, registrarse primero y luego ejecutar en una terminal 
	UPDATE usuarios SET rol='super' WHERE idUsuario=?, siendo ? el usuario creado


Los distintos valores que puede tomar la columna rol son: 'registrado', 'moderador',
							     'gestor' y 'super'.
*/
