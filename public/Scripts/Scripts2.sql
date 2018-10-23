CREATE TABLE `cenpiclinic`.`adm_perfil`(  
  `idPerfil` INT NOT NULL AUTO_INCREMENT,
  `nombrePerfil` VARCHAR(30) NOT NULL,
  `descPerfil` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`idPerfil`)
);

CREATE TABLE `cenpiclinic`.`adm_accion`(  
  `idAccion` INT NOT NULL AUTO_INCREMENT,
  `nombreAccion` VARCHAR(30) NOT NULL,
  `descAccion` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`idAccion`)
);

CREATE TABLE `cenpiclinic`.`adm_permiso`(  
  `accion` INT NOT NULL,
  `perfil` INT NOT NULL,
  PRIMARY KEY (`accion`, `perfil`),
  CONSTRAINT `permisoFKperfil` FOREIGN KEY (`perfil`) REFERENCES `cenpiclinic`.`adm_perfil`(`idPerfil`),
  CONSTRAINT `permisoFKaccion` FOREIGN KEY (`accion`) REFERENCES `cenpiclinic`.`adm_accion`(`idAccion`)
);

ALTER TABLE `cenpiclinic`.`adm_permiso`   
  DROP INDEX `permisoFKperfil`,
  ADD  KEY `permisoFKperfilFKaccion` (`perfil`, `accion`);
  
  CREATE TABLE `cenpiclinic`.`adm_tipo_documento`(  
  `idTipoDocumento` INT NOT NULL AUTO_INCREMENT,
  `nombreTipoDocumento` VARCHAR(30) NOT NULL,
  `iniciales` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`idTipoDocumento`)
);

CREATE TABLE `cenpiclinic`.`adm_genero`(  
  `idGenero` INT NOT NULL AUTO_INCREMENT,
  `nombreGenero` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`idGenero`)
);

CREATE TABLE `cenpiclinic`.`usuario_estado`(  
  `idEstado` INT NOT NULL,
  `nombreEstado` VARCHAR(30) NOT NULL,
  `descEstado` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`idEstado`)
);

CREATE TABLE `cenpiclinic`.`usuario`(  
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `tipoDocumento` INT NOT NULL,
  `documento` VARCHAR(50) NOT NULL,
  `primerNombre` VARCHAR(30) NOT NULL,
  `segundoNombre` VARCHAR(30),
  `primerApellido` VARCHAR(30) NOT NULL,
  `segundoApellido` VARCHAR(30),
  `direccion` VARCHAR(500) NOT NULL,
  `genero` INT NOT NULL,
  `correo` VARCHAR(100) NOT NULL,
  `telefono` VARCHAR(12) NOT NULL,
  `contrasena` VARCHAR(2000) NOT NULL,
  `fechaNacimiento` DATE NOT NULL,
  `estado` INT NOT NULL,
  `perfil` INT NOT NULL,
  `fechaCreacion` DATETIME NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE INDEX `docUnique` (`documento`),
  UNIQUE INDEX `correoUnique` (`correo`),
  FOREIGN KEY (`tipoDocumento`) REFERENCES `cenpiclinic`.`adm_tipo_documento`(`idTipoDocumento`),
  FOREIGN KEY (`genero`) REFERENCES `cenpiclinic`.`adm_genero`(`idGenero`),
  FOREIGN KEY (`estado`) REFERENCES `cenpiclinic`.`usuario_estado`(`idEstado`),
  FOREIGN KEY (`perfil`) REFERENCES `cenpiclinic`.`adm_perfil`(`idPerfil`)
);

CREATE TABLE `cenpiclinic`.`asistencial_tipo`(  
  `idAsistencialTipo` INT NOT NULL AUTO_INCREMENT,
  `nombreAsistencialTipo` VARCHAR(30) NOT NULL,
  `descAsistencialTipo` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`idAsistencialTipo`)
);
  
CREATE TABLE `cenpiclinic`.`asistencial_especialidad`(  
  `idAsistencialEspecialida` INT NOT NULL AUTO_INCREMENT,
  `nombreAsistencialEspecialidad` VARCHAR(30) NOT NULL,
  `descAsistencialEspecialidad` VARCHAR(300) NOT NULL,
  `asistencialTipo` INT NOT NULL,
  PRIMARY KEY (`idAsistencialEspecialida`),
  FOREIGN KEY (`asistencialTipo`) REFERENCES `cenpiclinic`.`asistencial_tipo`(`idAsistencialTipo`)
);

CREATE TABLE `cenpiclinic`.`asistencial`(  
  `idAsistencial` INT NOT NULL AUTO_INCREMENT,
  `usuario` INT NOT NULL,
  `especialidad` INT NOT NULL,
  PRIMARY KEY (`idAsistencial`),
  UNIQUE INDEX `usuarioUnique` (`usuario`),
  FOREIGN KEY (`especialidad`) REFERENCES `cenpiclinic`.`asistencial_especialidad`(`idAsistencialEspecialida`),
  FOREIGN KEY (`usuario`) REFERENCES `cenpiclinic`.`usuario`(`idUsuario`)
);

CREATE TABLE `cenpiclinic`.`adm_eps`(  
  `idEps` INT NOT NULL AUTO_INCREMENT,
  `nitEps` VARCHAR(50),
  `nombreEps` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idEps`)
);

CREATE TABLE `cenpiclinic`.`adm_regimen`(  
  `idRegimen` INT NOT NULL AUTO_INCREMENT,
  `nombreRegimen` VARCHAR(30) NOT NULL,
  `descRegimen` VARCHAR(300),
  PRIMARY KEY (`idRegimen`)
);

CREATE TABLE `cenpiclinic`.`adm_zona`(  
  `idZona` INT NOT NULL AUTO_INCREMENT,
  `nombreZona` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idZona`)
);

CREATE TABLE `cenpiclinic`.`adm_pais`(  
  `idPais` INT NOT NULL AUTO_INCREMENT,
  `nombrePais` VARCHAR(30) NOT NULL,
  `codigoPais` VARCHAR(5),
  PRIMARY KEY (`idPais`)
);

CREATE TABLE `cenpiclinic`.`adm_provincia`(  
  `idProvincia` INT NOT NULL AUTO_INCREMENT,
  `nombreProvincia` VARCHAR(30) NOT NULL,
  `pais` INT NOT NULL,
  `codigoArea` VARCHAR(30),
  PRIMARY KEY (`idProvincia`),
  FOREIGN KEY (`pais`) REFERENCES `cenpiclinic`.`adm_pais`(`idPais`)
);

CREATE TABLE `cenpiclinic`.`adm_municipio`(  
  `idMunicipio` INT NOT NULL AUTO_INCREMENT,
  `nombreMunicipio` VARCHAR(30) NOT NULL,
  `provincia` INT NOT NULL,
  PRIMARY KEY (`idMunicipio`),
  FOREIGN KEY (`provincia`) REFERENCES `cenpiclinic`.`adm_provincia`(`idProvincia`)
);

CREATE TABLE `cenpiclinic`.`paciente_tipo_afiliacion`(  
  `idTipoAfiliacion` INT NOT NULL AUTO_INCREMENT,
  `nombreTipoAfiliacion` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idTipoAfiliacion`)
);

CREATE TABLE `cenpiclinic`.`paciente_parentezco`(  
  `idParentezco` INT NOT NULL AUTO_INCREMENT,
  `nombreParentezco` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`idParentezco`)
);

CREATE TABLE `cenpiclinic`.`paciente_rango_salarial`(  
  `idRangoSalarial` INT NOT NULL AUTO_INCREMENT,
  `nombreRangoSalarial` VARCHAR(30) NOT NULL,
  `porcentaje` DOUBLE UNSIGNED,
  PRIMARY KEY (`idRangoSalarial`)
);

CREATE TABLE `cenpiclinic`.`paciente`(  
  `idPaciente` INT NOT NULL AUTO_INCREMENT,
  `tipoDocumento` INT NOT NULL,
  `fechaNacimiento` DATE NOT NULL,
  `documento` VARCHAR(50) NOT NULL,
  `primerNomber` VARCHAR(30) NOT NULL,
  `segundoNombre` VARCHAR(30),
  `primerApellido` VARCHAR(30) NOT NULL,
  `segundoApellido` VARCHAR(30),
  `genero` INT NOT NULL,
  `direccion` VARCHAR(500) NOT NULL,
  `email` VARCHAR(100),
  `telefono` VARCHAR(10),
  `celular` VARCHAR(15),
  `eps` INT NOT NULL,  
  `municipio` INT NOT NULL,
  `zona` INT NOT NULL,
  `regimen` INT NOT NULL,
  `tipoAfiliacion` INT NOT NULL,
  `parentezco` INT NOT NULL,  
  `rangoSalarial` INT NOT NULL,  
  `fechaIngreso` DATETIME NOT NULL,
  PRIMARY KEY (`idPaciente`),
  UNIQUE INDEX `documentoUnique` (`documento`),
  UNIQUE INDEX `correoUnique` (`email`),
  FOREIGN KEY (`tipoDocumento`) REFERENCES `cenpiclinic`.`adm_tipo_documento`(`idTipoDocumento`),
  FOREIGN KEY (`genero`) REFERENCES `cenpiclinic`.`adm_genero`(`idGenero`),
  FOREIGN KEY (`eps`) REFERENCES `cenpiclinic`.`adm_eps`(`idEps`),  
  FOREIGN KEY (`municipio`) REFERENCES `cenpiclinic`.`adm_municipio`(`idMunicipio`),
  FOREIGN KEY (`zona`) REFERENCES `cenpiclinic`.`adm_zona`(`idZona`),
  FOREIGN KEY (`regimen`) REFERENCES `cenpiclinic`.`adm_regimen`(`idRegimen`),
  FOREIGN KEY (`tipoAfiliacion`) REFERENCES `cenpiclinic`.`paciente_tipo_afiliacion`(`idTipoAfiliacion`),
  FOREIGN KEY (`parentezco`) REFERENCES `cenpiclinic`.`paciente_parentezco`(`idParentezco`),
  FOREIGN KEY (`rangoSalarial`) REFERENCES `cenpiclinic`.`paciente_rango_salarial`(`idRangoSalarial`)
);






































