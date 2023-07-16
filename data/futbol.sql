DROP DATABASE IF EXISTS futbol2023;
CREATE DATABASE futbol2023;
USE futbol2023;

CREATE TABLE campos(
id int,
nombre varchar(300),
aforo int,
precio float,
direccion varchar(400),
telefono varchar(20),
tipo varchar(200),
PRIMARY KEY(id)
);

CREATE TABLE socios(
id int,
nombre varchar(200),
apellidos varchar(400),
email varchar(200),
telefono varchar(20),
fechahora timestamp DEFAULT CURRENT_TIMESTAMP,
password varchar(100),
PRIMARY KEY(id),
UNIQUE KEY(email)
);

CREATE TABLE alquileres(
id int,
idSocio int,
idCampo int,
fechaHora timestamp,
horas int,
personas int,
precioTotal float,
PRIMARY KEY(id),
UNIQUE KEY(idSocio,idCampo,fechaHora)
);

ALTER TABLE alquileres
  ADD CONSTRAINT fkAlquileresSocios FOREIGN KEY (idSocio) REFERENCES socios(id),
  ADD CONSTRAINT fkAlquileresCampos FOREIGN KEY (idCampo) REFERENCES campos(id);
