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
  `sucursales_k` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `descripcion` VARCHAR(70) NULL COMMENT '',
  `activo` VARCHAR(45) NULL DEFAULT '1' COMMENT '',
  PRIMARY KEY (`sucursal_k`)  COMMENT '');

ALTER TABLE `usuario`
ADD COLUMN `puesto_k` INT NULL COMMENT '' AFTER `telefono_celular`,
ADD COLUMN `sucursal_k` INT NULL COMMENT '' AFTER `puesto_k`;
