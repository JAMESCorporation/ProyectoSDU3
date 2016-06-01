DROP DATABASE James;
CREATE DATABASE James;

USE James;

-- -----------------------------------------------------
-- Tabla - Usuario
-- -----------------------------------------------------
CREATE TABLE Usuario (
  id_usuario INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(45) NOT NULL,
  apellidos VARCHAR(60) NULL,
  direccion VARCHAR(100) NULL,
  telefono VARCHAR(45) NULL,
  correo VARCHAR(45) NOT NULL,
  password CHAR(64) NOT NULL,
  fecha_nacimiento DATE NULL,
  tipo INT NULL,
  PRIMARY KEY (id_usuario));

INSERT INTO Usuario VALUES (null,'Efren','Cruz','San Felipe','7121015229','efren@gmail.com',md5('efren'),'1994-10-24',1);
INSERT INTO Usuario VALUES (null,'Saúl','Gómez Navarrete','Jocotitlán','7121675322','minsau2@gmail.com',md5('saul'),'1994-03-11',1);

-- -----------------------------------------------------
-- Tabla - Categoria
-- -----------------------------------------------------
CREATE TABLE Categoria (
  id_categoria INT NOT NULL AUTO_INCREMENT,
  nombre_categoria VARCHAR(60) NOT NULL,
  PRIMARY KEY (id_categoria));

INSERT INTO Categoria VALUES (null,'Redes');
INSERT INTO Categoria VALUES (null,'Idiomas');
INSERT INTO Categoria VALUES (null,'Programación');
INSERT INTO Categoria VALUES (null,'Base de Datos');

-- -----------------------------------------------------
-- Tabla - Curso
-- -----------------------------------------------------
CREATE TABLE Curso (
  id_curso INT NOT NULL AUTO_INCREMENT,
  nombre_curso VARCHAR(45) NOT NULL,
  descripcion_curso TEXT NULL,
  costo FLOAT NOT NULL DEFAULT 0.0,
  fecha_inicio DATE NOT NULL,
  imagen longblob,
  tipo_imagen varchar(50),
  PRIMARY KEY (id_curso));

INSERT INTO Curso VALUES (null,'Android','Aquí veremos Android',100.0,'2016-05-21',null,null);

-- -----------------------------------------------------
-- Tabla - Tutorial
-- -----------------------------------------------------
CREATE TABLE Tutorial (
  id_tutorial INT NOT NULL AUTO_INCREMENT,
  nombre_tutorial VARCHAR(45) NOT NULL,
  descripcion_tutorial VARCHAR(45) NULL,
  video longblob NOT NULL,
  tipo_video varchar(50),
  visitas INT NULL DEFAULT 0,
  `like` INT NULL DEFAULT 0,
  tipo INT NULL,
  fecha_creacion TIMESTAMP NULL,
  id_curso INT NOT NULL,
  PRIMARY KEY (id_tutorial, id_curso),
  FOREIGN KEY (id_curso) REFERENCES Curso (id_curso));


-- -----------------------------------------------------
-- Tabla - Comentario
-- -----------------------------------------------------
CREATE TABLE Comentario (
  id_comentario INT NOT NULL AUTO_INCREMENT,
  comentario VARCHAR(200) NOT NULL,
  fecha TIMESTAMP NULL,
  id_usuario INT NOT NULL,
  id_tutorial INT NOT NULL,
  PRIMARY KEY (id_comentario, id_usuario),
  FOREIGN KEY (id_usuario) REFERENCES Usuario (id_usuario),
  FOREIGN KEY (id_tutorial) REFERENCES Tutorial (id_tutorial));



-- -----------------------------------------------------
-- Tabla - Pago
-- -----------------------------------------------------
CREATE TABLE Pago (
  id_pago INT NOT NULL AUTO_INCREMENT,
  cuenta VARCHAR(50) NOT NULL,
  cantidad FLOAT NOT NULL,
  fecha_pago TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_pago));

-- -----------------------------------------------------
-- Tabla - Test
-- -----------------------------------------------------
CREATE TABLE Test (
  id_test INT NOT NULL AUTO_INCREMENT,
  id_tutorial INT NOT NULL,
  PRIMARY KEY (id_test, id_tutorial),
  FOREIGN KEY (id_tutorial) REFERENCES Tutorial (id_tutorial));

-- -----------------------------------------------------
-- Tabla - Pregunta
-- -----------------------------------------------------
CREATE TABLE Pregunta (
  id_pregunta INT NOT NULL AUTO_INCREMENT,
  pregunta VARCHAR(300) NOT NULL,
  id_test INT NOT NULL,
  PRIMARY KEY (id_pregunta, id_test),
  FOREIGN KEY (id_test) REFERENCES Test (id_test));

-- -----------------------------------------------------
-- Tabla - Respuesta
-- -----------------------------------------------------
CREATE TABLE Respuesta (
  id_respuesta INT NOT NULL AUTO_INCREMENT,
  respuesta VARCHAR(300) NOT NULL,
  correcta INT NOT NULL,
  id_pregunta INT NOT NULL,
  PRIMARY KEY (id_respuesta),
  FOREIGN KEY (id_pregunta) REFERENCES Pregunta (id_pregunta));

-- -----------------------------------------------------
-- Tabla - Usuario_has_Curso
-- -----------------------------------------------------
CREATE TABLE Usuario_has_Curso (
  id_usuario INT NOT NULL,
  id_curso INT NOT NULL,
  estado INT NOT NULL,
  PRIMARY KEY (id_usuario, id_curso),
  FOREIGN KEY (id_usuario) REFERENCES Usuario (id_usuario),
  FOREIGN KEY (id_curso) REFERENCES Curso (id_curso));


-- -----------------------------------------------------
-- Tabla - Categoria_has_Curso
-- -----------------------------------------------------
CREATE TABLE Curso_has_Categoria (
  id_categoria INT NOT NULL,
  id_curso INT NOT NULL,
  PRIMARY KEY (id_categoria, id_curso),
  FOREIGN KEY (id_categoria) REFERENCES Categoria (id_categoria),
  FOREIGN KEY (id_curso) REFERENCES Curso (id_curso));

INSERT INTO Curso_has_Categoria VALUES (1,1);

-- -----------------------------------------------------
-- Tabla - Usuario_has_Test
-- -----------------------------------------------------
CREATE TABLE Usuario_has_Test (
  id_usuario INT NOT NULL,
  id_test INT NOT NULL,
  calificacion DOUBLE NULL,
  fecha VARCHAR(45) NULL,
  PRIMARY KEY (id_usuario, id_test),
  FOREIGN KEY (id_usuario) REFERENCES Usuario (id_usuario),
  FOREIGN KEY (id_test) REFERENCES Test (id_test));