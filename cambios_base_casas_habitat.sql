//Fecha: 06/06/2016
//Autor: Jair Almaraz Saldaña
ALTER TABLE `cliente`
ADD COLUMN `interes_k` INT NULL COMMENT '' AFTER `usuario_atencion`;



INSERT INTO `cat_servicios` (`descripcion`, `activo`) VALUES ('comprar', '1');
INSERT INTO `cat_servicios` (`descripcion`, `activo`) VALUES ('vender', '1');
INSERT INTO `cat_servicios` (`descripcion`, `activo`) VALUES ('remodelar', '1');
INSERT INTO `cat_servicios` (`descripcion`, `activo`) VALUES ('construir', '1');
INSERT INTO `cat_servicios` (`descripcion`, `activo`) VALUES ('mantenimiento', '1');


CREATE TABLE `cat_puestos` (
  `puesto_k` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `descripcion` VARCHAR(70) NULL COMMENT '',
  `activo` VARCHAR(45) NULL DEFAULT '1' COMMENT '',
  PRIMARY KEY (`puesto_k`)  COMMENT '');

  CREATE TABLE `cat_sucursales` (
  `sucursal_k` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `descripcion` VARCHAR(70) NULL COMMENT '',
  `activo` VARCHAR(45) NULL DEFAULT '1' COMMENT '',
  PRIMARY KEY (`sucursal_k`)  COMMENT '');

ALTER TABLE `usuario`
ADD COLUMN `puesto_k` INT NULL COMMENT '' AFTER `telefono_celular`,
ADD COLUMN `sucursal_k` INT NULL COMMENT '' AFTER `puesto_k`;



//Fecha: 09/06/2016
ALTER TABLE `casa` 
ADD COLUMN `edificio` VARCHAR(45) NULL COMMENT '' AFTER `estatus_venta`;

CREATE TABLE `propuestas_tmp` (
  `propuesta_tmp_k` int(11) NOT NULL AUTO_INCREMENT,
  `casa_k` int(11) DEFAULT NULL,
  `cliente_k` int(11) DEFAULT NULL,
  `pago_contado` float DEFAULT NULL,
  `precio_pactado` float DEFAULT NULL,
  `anticipo` float DEFAULT NULL,
  `mensualidades` int(11) DEFAULT NULL,
  `comercializacion` float DEFAULT NULL,
  `usuario_creacion` int(11) DEFAULT NULL,
  `fecha_hora_creacion` datetime DEFAULT NULL,
  PRIMARY KEY (`propuesta_tmp_k`)
);

CREATE TABLE `pagos_propuesta_tmp` (
  `pago_propuesta_k` int(11) NOT NULL AUTO_INCREMENT,
  `propuesta_tmp_k` int(11) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`pago_propuesta_k`)
);


