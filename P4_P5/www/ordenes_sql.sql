--Órdenes para comprobar la BD
--Para crear las tablas


CREATE TABLE `eventos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `ruta_artista` varchar(100) DEFAULT NULL,
  `ruta_sitio` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `fotografo` varchar(100) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`)
);


CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `esGestor` bit(1) DEFAULT NULL,
  `esModerador` bit(1) DEFAULT NULL,
  `esSuper` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
);



CREATE TABLE `comentarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `texto` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_usuario` int NOT NULL,
  `id_evento` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_evento` (`id_evento`),
  CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`)
);



--Algunos INSERT INTO sueltos

INSERT INTO eventos (nombre, lugar, ruta_artista, ruta_sitio, descripcion, fotografo, web, fecha) VALUES ('The Drums', 'Sala Marron, Fuengirola', 'img/drums.jpg', 'img/sala.jpg', 'Descripcion', 'Sara Ejemplo', 'www.ejemplo.com', '2021-11-07');

INSERT INTO usuarios (nombre, email, pass, esGestor, esModerador, esSuper) VALUES ('Dani', 'dani@hotmail.com', '$2y$10$HCeUo8UbT2IjyX3e/tOQeu32KCqx8X6znD9S.JKqfW6emWf8k7mG2',1,1,1);


INSERT INTO comentarios (texto, fecha, id_usuario, id_evento) VALUES ('Pf Sunflower es mejor ', '2020-04-04', '3', '9');


DROP TABLE comentarios;
DROP TABLE usuarios;
DROP TABLE eventos;



