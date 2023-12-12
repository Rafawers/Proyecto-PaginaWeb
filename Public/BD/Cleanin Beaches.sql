CREATE DATABASE cleaninbeaches;
use cleaninbeaches;

CREATE TABLE Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_completo VARCHAR(50) NOT NULL,
    correo VARCHAR(50) UNIQUE NOT NULL,
    usuario VARCHAR(50) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE donaciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    fecha VARCHAR(50) NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    correo_usuario VARCHAR(50) NOT NULL,
    CONSTRAINT fk_usuario_correo FOREIGN KEY (correo_usuario) REFERENCES Usuarios(correo)
);

CREATE TABLE Eventos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre_evento VARCHAR(100) NOT NULL,
    fecha_evento DATE NOT NULL,
    ubicacion VARCHAR(100) NOT NULL,
    descripcion TEXT,
    usuarios_id INT,
    CONSTRAINT fk_usuarios_id FOREIGN KEY (usuarios_id) REFERENCES Usuarios(id)
);

CREATE TABLE reg_donacion(
    nombre VARCHAR(100) NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    registro datetime
);

CREATE TRIGGER donaciones_AI 
AFTER INSERT ON donaciones FOR EACH ROW
INSERT INTO reg_donacion (nombre, monto, registro)
VALUES (new.nombre, new.monto, NOW());

CREATE TABLE reg_donacionEli(
   nombre VARCHAR(100) NOT NULL,
   monto DECIMAL(10, 2) NOT NULL,
   registro datetime
);

CREATE TRIGGER donaciones_AD
AFTER DELETE ON donaciones for EACH ROW
INSERT INTO reg_donacionEli (nombre, monto, registro)
VALUES (OLD.nombre, OLD.monto, NOW());
