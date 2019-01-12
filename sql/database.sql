DROP DATABASE IF EXISTS comedor;
CREATE DATABASE comedor;
USE comedor;

CREATE TABLE pnf(
  id INT AUTO_INCREMENT NOT NULL,
  nom VARCHAR(100) NOT NULL,
  UNIQUE(nom),
  cterm VARCHAR(20) NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDb DEFAULT CHARACTER SET = utf8;

INSERT INTO pnf VALUES
  (null, 'Informática', '0303'),
  (null, 'Turismo', '0306'),
  (null, 'Construcción Civil', '0302'),
  (null, 'Psicología', '0309'),
  (null, 'Administración', '0304'),
  (null, 'Contaduría Pública', '0307'),
  (null, 'Agroalimentación', '0301'),
  (null, 'Enfermería', '0312'),
  (null, 'Nutrición y Dietética', '0310');

CREATE TABLE estudiante(
  nombre VARCHAR(90) NOT NULL,
  apellido VARCHAR(90) NOT NULL,
  cedula VARCHAR(20) NOT NULL,
  UNIQUE(cedula),
  nacionalidad VARCHAR(50) NULL,
  carnet VARCHAR(20) NOT NULL,
  UNIQUE(carnet),
  carrera VARCHAR(50) NOT NULL,
  trayecto VARCHAR(30) NOT NULL,
  seccion VARCHAR(10) NOT NULL,
  reg VARCHAR(2) NOT NULL,
  PRIMARY KEY(carnet)
) ENGINE=InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE docente(
  nom VARCHAR(90) NOT NULL,
  ape VARCHAR(90) NOT NULL,
  ced VARCHAR(20) NOT NULL,
  UNIQUE(ced),
  tlf VARCHAR(16) NOT NULL,
  reg VARCHAR(2) NOT NULL,
  PRIMARY KEY (ced)
) ENGINE = InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE registro(
  id INT AUTO_INCREMENT NOT NULL,
  carnet VARCHAR(20) NOT NULL,
  UNIQUE(carnet),
  dias VARCHAR(200) NOT NULL,
  fault INT NOT NULL,
  FOREIGN KEY (carnet) REFERENCES estudiante (carnet) ON UPDATE CASCADE ON DELETE CASCADE,
  PRIMARY KEY(id)
) ENGINE=InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE registroC(
  id INT AUTO_INCREMENT NOT NULL,
  ced VARCHAR(20) NOT NULL,
  UNIQUE(ced),
  dias VARCHAR(200) NOT NULL,
  fault INT NOT NULL,
  FOREIGN KEY (ced) REFERENCES docente (ced) ON UPDATE CASCADE ON DELETE CASCADE,
  PRIMARY KEY(id)
) ENGINE=InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE asistencia(
  id INT AUTO_INCREMENT NOT NULL COMMENT 'Identificador Unico',
  carnet VARCHAR(20) NOT NULL,
  fecha DATE NOT NULL,
  week INT NOT NULL,
  month INT NOT NULL,
  FOREIGN KEY (carnet) REFERENCES registro(carnet) ON UPDATE CASCADE,
  PRIMARY KEY(id)
) ENGINE=InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE asistenciaC(
  id INT AUTO_INCREMENT NOT NULL COMMENT 'Identificador Unico',
  ced VARCHAR(20) NOT NULL,
  fecha DATE NOT NULL,
  week INT NOT NULL,
  month INT NOT NULL,
  FOREIGN KEY (ced) REFERENCES registroC(ced) ON UPDATE CASCADE,
  PRIMARY KEY(id)
) ENGINE=InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE asistenciaO(
  id INT AUTO_INCREMENT NOT NULL COMMENT 'Identificador Unico',
  nomape VARCHAR(200) NOT NULL,
  ci VARCHAR(20) NOT NULL,
  fecha DATE NOT NULL,
  week INT NOT NULL,
  month INT NOT NULL,
  PRIMARY KEY(id)
) ENGINE=InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE inventario(
  id INT AUTO_INCREMENT NOT NULL,
  nom VARCHAR(90) NOT NULL,
  UNIQUE(nom),
  cant FLOAT NOT NULL,
  fecha DATE NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE usoInventario(
  id INT AUTO_INCREMENT NOT NULL,
  cant FLOAT NOT NULL,
  fecha DATE NOT NULL,
  id_inv INT NOT NULL,
  FOREIGN KEY (id_inv) REFERENCES inventario (id) ON UPDATE CASCADE ON DELETE CASCADE,
  PRIMARY KEY (id)
) ENGINE = InnoDb DEFAULT CHARACTER SET = utf8;

CREATE TABLE usuarios (
  id INT AUTO_INCREMENT COMMENT 'Id de Usuario',
  clave VARCHAR(50) NOT NULL COMMENT 'Clave de Acceso',
  UNIQUE(clave),
  nusu VARCHAR(50) NOT NULL COMMENT 'Nombre de Acceso',
  UNIQUE(nusu),
  nom VARCHAR(50) NOT NULL COMMENT 'Nombre de Usuario',
  ape VARCHAR(50) NOT NULL COMMENT 'Apellido de Usuario',
  tlf VARCHAR(20) NOT NULL COMMENT 'Telefono de Usuario',
  mail VARCHAR(80) NOT NULL COMMENT 'Correo Electronico de Usuario',
  tipo INT(11) NOT NULL COMMENT 'Tipo de Usuario',
  ask VARCHAR(100) NOT NULL COMMENT 'pregunta seguridad',
  res VARCHAR(100) NOT NULL COMMENT 'respuesta seguridad',
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARACTER SET = utf8;

INSERT INTO usuarios VALUES
(null, MD5('admin'), 'uptm', 'pepe', 'sad', '0000-0000000', 'pepe@sadmail.com', 1, 'pregunta', 'respuesta'),
(null, MD5('usu'), 'usuario', 'pedro', 'feels', '0000-0000000', 'pedro@feelmail.com', 2, 'pregunta', 'respuesta');
