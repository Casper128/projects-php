CREATE TABLE servicios (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  costo DECIMAL(8,2) NOT NULL
);

CREATE TABLE horarios_disponibilidad (
  id INT PRIMARY KEY AUTO_INCREMENT,
  hora TIME NOT NULL
);

CREATE TABLE clientes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  telefono VARCHAR(20),
  usuario VARCHAR(100),
  password VARCHAR(100),
  admin BOOLEAN NOT NULL
);

CREATE TABLE citas (
  id INT PRIMARY KEY AUTO_INCREMENT,
  cliente_id INT NOT NULL,
  servicio_id INT NOT NULL,
  hora VARCHAR(10),
  fecha_hora DATETIME NOT NULL,
  FOREIGN KEY (servicio_id) REFERENCES servicios(id),
  FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);


SELECT * FROM `citas` INNER JOIN clientes ON citas.cliente_id = clientes.id
INNER JOIN servicios ON servicios.id=citas.servicio_id