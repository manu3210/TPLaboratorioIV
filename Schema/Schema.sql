#creamos la base de datos
CREATE DATABASE IF NOT EXISTS labo4;

#seleccionamos la base de datos
USE labo4;

#creamos la tabla de usuarios 
CREATE TABLE IF NOT EXISTS usuarios(
	idUsuario INT NOT NULL auto_increment ,
    email VARCHAR(35) NOT NULL unique,
    pass VARCHAR(35) NOT NULL,
    tipo smallint,
    descripcion VARCHAR(120),
    alreadyAplied smallint,
    idAPI int,
    
    constraint `idUsuario` primary key(idUsuario)
)ENGINE=INNODB;

#creamos la tabla de companias 
CREATE TABLE IF NOT EXISTS companias(
	idCompania INT NOT NULL auto_increment ,
    nombre VARCHAR(35) NOT NULL unique,
    email VARCHAR(35) NOT NULL,
    pass VARCHAR(35) NOT NULL,
    isActive smallint,
    phoneNumber VARCHAR(25) NOT NULL,
    
     constraint `idCompania` primary key(idCompania)
)ENGINE=INNODB;

#tabla para ofertasLaborales
create table if not exists ofertasLaborales(
	idJobOffer int not null auto_increment,
    idCompania INT NOT NULL,
    jobPosition smallint,
    fechaCaducidad date,
    
    constraint idJobOffer primary key(idJobOffer),
    constraint idCompania foreign key (idCompania) references companias(idCompania)
)ENGINE=INNODB;

#tabla para postulacionesXUsuarios
create table if not exists postulacionesXUsuarios(
	idPostulacionesXUsuarios int not null auto_increment,
    idJobOffer INT NOT NULL,
    idUsuario INT NOT NULL,
    constraint idPostulacionesXUsuarios primary key(idPostulacionesXUsuarios),
    constraint idJobOffer foreign key (idJobOffer) references ofertasLaborales(idJobOffer),
    constraint idUsuario foreign key (idUsuario) references usuarios(idUsuario)
)ENGINE=INNODB;

#insert into companias (`nombre` ,`email`,`isActive`,`phoneNumber` ) values("Link","link@link.com",1,"223-5481274");
#insert into companias (`nombre` ,`email`,`isActive`,`phoneNumber` ) values("Coto","coto@coto.com",1,"223-5481457");
#insert into companias (`nombre` ,`email`,`isActive`,`phoneNumber` ) values("Phillips","phillips@phillips.com",1,"223-5846597");
#insert into companias (`nombre` ,`email`,`isActive`,`phoneNumber` ) values("Sanyo","sanyo@sanyo.com",1,"223-5848648");
