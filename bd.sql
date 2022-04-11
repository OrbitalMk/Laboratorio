DROP DATABASE IF EXISTS Laboratorio;

CREATE DATABASE Laboratorio;
use Laboratorio;


-- Utilizado para columnas con espacio ej: "Fecha de recepcion"
set sql_mode = 'ANSI_QUOTES';

/* TABLAS */

CREATE TABLE Cliente(
idCliente INT AUTO_INCREMENT PRIMARY KEY,
nombres VARCHAR(20) NOT NULL,
apellidos VARCHAR(20) NOT NULL,
nacimiento DATE NOT NULL,
edad INT GENERATED ALWAYS AS (TIMESTAMPDIFF(YEAR, nacimiento, CURDATE())),
inss VARCHAR(20),
direccion VARCHAR(50),
telefono VARCHAR(10),
sexo ENUM('Femenino', 'Masculino') NOT NULL,
estado BOOLEAN DEFAULT TRUE NOT NULL
);

CREATE TABLE Medico(
idMedico INT AUTO_INCREMENT PRIMARY KEY,
nombres VARCHAR(20) NOT NULL,
apellidos VARCHAR(20) NOT NULL,
codigoSanitario VARCHAR(20) NOT NULL,
telefono VARCHAR(10),
estado BOOLEAN DEFAULT TRUE NOT NULL
);

CREATE TABLE Recepcionista(
idRecepcionista INT AUTO_INCREMENT PRIMARY KEY,
nombres VARCHAR(20) NOT NULL,
apellidos VARCHAR(20) NOT NULL,
cedula VARCHAR(16) UNIQUE NOT NULL,
telefono VARCHAR(10),
foto VARCHAR(100),
usuario VARCHAR(20) UNIQUE NOT NULL, /* ID */
pass VARCHAR(100) NOT NULL,
perfil ENUM('Administrador', 'especial', 'estandar') NOT NULL,
fechaCreacion DATE DEFAULT CURDATE(),
estado BOOLEAN DEFAULT TRUE NOT NULL
);

CREATE TABLE UnidadDeSalud(
idUnidadDeSalud INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(20) NOT NULL,
departamento VARCHAR(20) NOT NULL,
telefono VARCHAR(10),
estado BOOLEAN DEFAULT TRUE NOT NULL
);

CREATE TABLE TipoExamen(
idTipoExamen INT PRIMARY KEY,
descripcion VARCHAR(20) NOT NULL
);

CREATE TABLE DiagnosticoPatologico(
idDiagnostico INT PRIMARY KEY,
descripcion VARCHAR(100) NOT NULL
);

CREATE TABLE ProcedimientoQuirurgico(
idProcedimiento INT AUTO_INCREMENT PRIMARY KEY,
descripcion VARCHAR(50) NOT NULL
);

CREATE TABLE RegionAnatomica(
idRegionAnatomica INT AUTO_INCREMENT PRIMARY KEY,
descripcion VARCHAR(50) NOT NULL
);

CREATE TABLE Solicitud(
idSolicitud INT AUTO_INCREMENT PRIMARY KEY,
fechaRecepcion DATE NOT NULL,
fechaTomaMuestra DATE NOT NULL,
estado BOOLEAN DEFAULT TRUE NOT NULL,
idCliente INT NOT NULL,
idMedico INT NOT NULL,
idUnidadDeSalud INT NOT NULL,
idRecepcionista INT NOT NULL,
idTipoExamen INT NOT NULL,
FOREIGN KEY (idCliente) REFERENCES Cliente(idCliente),
FOREIGN KEY (idMedico) REFERENCES Medico(idMedico),
FOREIGN KEY (idUnidadDeSalud) REFERENCES UnidadDeSalud(idUnidadDeSalud),
FOREIGN KEY (idRecepcionista) REFERENCES Recepcionista(idRecepcionista),
FOREIGN KEY (idTipoExamen) REFERENCES TipoExamen(idTipoExamen)
);

CREATE TABLE SolicitudAP(
idSolicitud INT,
observaciones VARCHAR(40),
resultBiopsiaPrevia VARCHAR(100),
radioTerapia BOOLEAN NOT NULL,
biopsiaPrevia BOOLEAN NOT NULL,
idProcedimiento INT,
idRegionAnatomica INT,
FOREIGN KEY (idProcedimiento) REFERENCES ProcedimientoQuirurgico(idProcedimiento),
FOREIGN KEY (idRegionAnatomica) REFERENCES RegionAnatomica(idRegionAnatomica),
FOREIGN KEY (idSolicitud) REFERENCES Solicitud(idSolicitud)
);

CREATE TABLE SolicitudCGO(
idSolicitud INT,
idRegionAnatomica INT NOT NULL,
FUR DATE NOT NULL,
gestaciones INT NOT NULL,
partos INT NOT NULL,
abortos INT NOT NULL,
cesareas INT  NOT NULL,
La INT NOT NULL,
embarazo BOOLEAN NOT NULL,
contraconceptivos BOOLEAN NOT NULL,
DIU BOOLEAN,
radioTerapia BOOLEAN NOT NULL,
biopsiaPrevia BOOLEAN NOT NULL,
papPrevio DATE,
resultadoPapPrevio VARCHAR(50),
flujoVaginal VARCHAR(15), -- Crear tabla o enum
aspectoCervix VARCHAR(15), -- Crear tabla o enum
observaciones VARCHAR(50),
estado BOOLEAN NOT NULL,
FOREIGN KEY (idSolicitud) REFERENCES Solicitud(idSolicitud),
FOREIGN KEY (idRegionAnatomica) REFERENCES RegionAnatomica(idRegionAnatomica)
);


CREATE TABLE ResultadoAP(
idSolicitudAP INT,
idDiagnostico INT NOT NULL,
fechaEntrega DATE NOT NULL,
descripcionMacroscopica VARCHAR(50) NOT NULL,
estado BOOLEAN DEFAULT TRUE NOT NULL,
FOREIGN KEY (idDiagnostico) REFERENCES DiagnosticoPatologico(idDiagnostico),
FOREIGN KEY (idSolicitudAP) REFERENCES Solicitud(idSolicitud)
);

CREATE TABLE ResultadoCGO(
idSolicitudCGO INT,
fechaEntrega DATE NOT NULL,
adecuacioEspecimen ENUM('Satifaccion para evaluacion', 'Satifaccion pero limitado', 'Inadecuado') NOT NULL,
reaccionInflamatoria ENUM('Leve', 'Moderada', 'Severa', 'Ausente') NOT NULL,
flora ENUM('Bacilar', 'Cocoide', 'Mixta', 'No Visible') NOT NULL,
-- Inicio Micro Oragsnismos
monilias BOOLEAN NOT NULL,
triconomas BOOLEAN NOT NULL,
papiloma BOOLEAN NOT NULL,
garnerelia BOOLEAN NOT NULL,
herpes BOOLEAN NOT NULL,
otros BOOLEAN NOT NULL,
-- Final Micro Oragsnismos
celulasMalignas BOOLEAN NOT NULL,
atipiaEscamosa BOOLEAN NOT NULL,
lesionBajoGrado VARCHAR(20),
lesionAltoGrado VARCHAR(20),
carcinomaEscamosa VARCHAR(20),
adenocarcinoma VARCHAR(20),
-- Inicio Observaciones
control BOOLEAN NOT NULL,
tratamiento BOOLEAN NOT NULL,
colposcopia BOOLEAN NOT NULL,
biopsia BOOLEAN NOT NULL,
controlAnual BOOLEAN NOT NULL
-- Final Observaciones
);

/* PROCEDIMIENTOS ALMACENADOS */

DELIMITER //
CREATE PROCEDURE ClienteCrud(operacion char, pid int, pnombres varchar(20), papellidos varchar(20), pnacimiento date,
       pinss varchar(20), pdireccion varchar(50), ptelefono varchar(10), psexo varchar(15))
BEGIN
	CASE operacion
	     WHEN 'C' THEN
	     	  INSERT INTO Cliente(nombres, apellidos, nacimiento, inss, direccion, telefono, sexo)
		  	 VALUES (pnombres, papellidos, pnacimiento, pinss, pdireccion, ptelefono, psexo);
	     WHEN 'R' THEN
	     	  SELECT idCliente, nombres, apellidos, DATE_FORMAT(nacimiento, '%d/%m/%Y') as 'nacimiento', edad, inss, direccion, telefono, sexo, estado
		  	 FROM Cliente;
	     WHEN 'U' THEN
	     	  UPDATE Cliente set nombres=pnombres, apellidos=papellidos,
		  	 nacimiento=pnacimiento, inss=pinss, direccion=pdireccion,
		  	 telefono=ptelefono, sexo=psexo
		   	 WHERE idCliente=pid;
	     WHEN 'D' THEN
	     	  UPDATE Cliente SET estado=FALSE WHERE idCliente=pid;
	END CASE;
END; //
DELIMITER ;



DELIMITER //
CREATE PROCEDURE MedicoCrud(operacion char, pid int, pnombres varchar(20),
       papellidos varchar(20), pcodigoSani varchar(20), ptelefono varchar(10))
BEGIN
	CASE operacion
	     WHEN 'C' THEN
	     	  INSERT INTO Medico(nombres, apellidos, codigoSanitario, telefono)
		  	 VALUES (pnombres, papellidos, pcodigoSani, ptelefono);
	     WHEN 'R' THEN
	     	  SELECT * FROM Medico;
	     WHEN 'U' THEN
	     	  UPDATE Medico set nombres=pnombres, apellidos=papellidos,
		  	 codigoSanitario=pcodigoSani, telefono=ptelefono
		   	 WHERE idMedico=pid;
	     WHEN 'D' THEN
	     	  UPDATE Medico SET estado=FALSE WHERE idMedico=pid;
	END CASE;
END; //
DELIMITER ;



DELIMITER //
CREATE PROCEDURE RecepcionistaCrud(operacion char, pid int, pnombres varchar(20),
       papellidos varchar(20), pcedula varchar(20), ptelefono varchar(10),
       pfoto varchar(100), pusuario varchar(20), ppass varchar(100), pperfil varchar(20))
BEGIN
	CASE operacion
	     WHEN 'C' THEN
	     	  INSERT INTO Recepcionista(nombres, apellidos, cedula, telefono, foto, usuario, pass, perfil)
		  	 VALUES (pnombres, papellidos, pcedula, ptelefono, pfoto, pusuario, ppass, pperfil);
	     WHEN 'R' THEN
	     	  SELECT * FROM Recepcionista;
	     WHEN 'U' THEN
	     	  UPDATE Recepcionista set nombres=pnombres, apellidos=papellidos,
		  	 cedula=pcedula, telefono=ptelefono, foto=pfoto, usuario=pusuario, pass=ppass, perfil=pperfil
		   	 WHERE idRecepcionista=pid;
	     WHEN 'D' THEN
	     	  UPDATE Recepcionista SET estado=FALSE WHERE idRecepcionista=pid;
	END CASE;
END; //
DELIMITER ;



DELIMITER //
CREATE PROCEDURE UnidadCrud(operacion char, pid int, pnombre varchar(20),
       pdepartamento varchar(20), ptelefono varchar(10))
BEGIN
	CASE operacion
	     WHEN 'C' THEN
	     	  INSERT INTO UnidadDeSalud(nombre, departamento, telefono)
		  	 VALUES (pnombre, pdepartamento, ptelefono);
	     WHEN 'R' THEN
	     	  SELECT * FROM UnidadDeSalud;
	     WHEN 'U' THEN
	     	  UPDATE UnidadDeSalud set nombre=pnombre, departamento=pdepartamento, telefono=ptelefono
		   	 WHERE idUnidadDeSalud=pid;
	     WHEN 'D' THEN
	     	  UPDATE UnidadDeSalud SET estado=FALSE WHERE idUnidadDeSalud=pid;
	END CASE;
END; //
DELIMITER ;


/* VISTAS */
CREATE VIEW vRecepcionista
AS
select idRecepcionista, nombres, apellidos, cedula, telefono, foto, usuario
 from Recepcionista where estado=TRUE;

CREATE VIEW vSolicitud
AS
select s.idSolicitud,
 DATE_FORMAT(s.fechaTomaMuestra, '%d/%m/%Y') as 'Fecha de toma de muestra',
 DATE_FORMAT(s.fechaRecepcion, '%d/%m/%Y') as 'Fecha de recepcion',
 CONCAT(c.nombres, ' ', c.apellidos) as 'Paciente',
 CONCAT(m.nombres, ' ', m.apellidos) as 'Medico',
 CONCAT(r.nombres, ' ', r.apellidos) as 'Recepcionista',
 u.nombre as 'Centro de salud'
 from Solicitud s
 join Cliente c on s.idCliente = c.idCliente
 join Medico m on s.idMedico = m.idMedico
 join UnidadDeSalud u on u.idUnidadDeSalud = s.idUnidadDeSalud
 join Recepcionista r on r.idRecepcionista = s.idRecepcionista;

CREATE VIEW vSolicitudAP
AS
select s.idSolicitud, s.Paciente, s.Medico, "Centro de salud", s.Recepcionista, "Fecha de recepcion",
 "Fecha de toma de muestra", sap.observaciones, sap.resultBiopsiaPrevia, sap.radioTerapia,
 sap.biopsiaPrevia, pq.descripcion as 'Procedimiento quirurgico', ra.descripcion as 'Region anatomico'
 from vSolicitud s
 join SolicitudAP sap on sap.idSolicitud = s.idSolicitud
 join ProcedimientoQuirurgico pq on pq.idProcedimiento = sap.idProcedimiento
 join RegionAnatomica ra on ra.idRegionAnatomica = sap.idRegionAnatomica;

/* Insert */
insert into Cliente(nombres, apellidos, nacimiento, inss, direccion, telefono, sexo) values
('Jonathan Alexander', 'Guillen Lainez', '2002/07/22', '', '', '89580496', 'Masculino'),
('Heiner Alberto', 'Guillen Lainez', '2000/07/04', '', '', '22523075', 'Masculino'),
('Alberto Antonio', 'Emes Barahona', '2001/07/02', '', '', '89450496', 'Masculino'),
('Haniel Alexander', 'Orozco Martinez', '2002/07/02', '', '', '89450496', 'Masculino');

insert into Medico(nombres, apellidos, codigoSanitario, telefono, estado) values
('Roberto Antonio', 'Gonzalez Flores', '552212', '22523075', TRUE),
('Gaudy asd', 'Garcia Solorzano', '551212', '22523076', TRUE);

insert into UnidadDeSalud(nombre, departamento, telefono, estado) values
('Jsjsjs', 'Managua', '58101064', 1);

insert into Recepcionista(nombres, apellidos, cedula, telefono, foto, usuario, pass, estado) values
('Juan', 'Sanchez Flores', '001-221278-2020S', '22523075',
'/home/jonathan22/Descargas/29250-mac.jpg', 'Jon', '1234', TRUE);

insert into TipoExamen(idTipoExamen, descripcion) values
(1, 'AP'),
(2, 'CGO');

insert into Solicitud(fechaRecepcion, fechaTomaMuestra, estado, idCliente, idMedico, idUnidadDeSalud, idRecepcionista, idTipoExamen) values
('2002/07/02', '2002/06/01', TRUE, 1, 1, 1, 1, 1);

insert into ProcedimientoQuirurgico values
(1, 'Biopsia'),
(2, 'Exeresis'),
(3, 'Histeroctomia'),
(4, 'Colposcopia'),
(5, 'Endoscopia'),
(6, 'Colonoscopia'),
(7, 'BAF');

insert into RegionAnatomica values
(1, 'Utero'),
(2, 'Cervix'),
(3, 'Pectoral izquierdo'),
(4, 'Pectoral derecho'),
(5, 'Vejiga'),
(6, 'Tejido Blando'),
(7, 'Fistula perianal'),
(8, 'Maxilar superior izquierdo'),
(9, 'Maxilar superior derecho'),
(10, 'Trigono carotideo');

insert into DiagnosticoPatologico values
(1, 'diagnostico patologico');

insert into SolicitudAP(idSolicitud, observaciones, resultBiopsiaPrevia, radioTerapia, biopsiaPrevia, idProcedimiento, idRegionAnatomica) values
(1, 'Zancudo', NULL, FALSE, FALSE, 3, 1);
