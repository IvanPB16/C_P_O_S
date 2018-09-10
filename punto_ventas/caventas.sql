create database compuactual;
use compuactual;

create table usuario(
id_usuario int(11) primary_key auto_increment,
nombre varchar(50) not null,
nom_usuario varchar(50) not null,
contraseña varchar(50) not null,
cargo varchar(50) not null,
imagen text not null
);

create table categoria(
id_categoria int(11) primary_key auto_increment,
nombre varchar(50) not null,
fecha timestamp
);

create table subcategoria(
id_subcategoria int(11) primary_key auto_increment,
nombre varchar(50) not null,
fecha timestamp
);

create table venta(
id_venta int(11) not null,
ventas,
formas_pago
total 
);

create table productos(
id_productos int(11) not null,
codigo varchar(11) not null,
descripcion varchar(100) not null,
precio_compra float not null,
precio_venta float not null,
stock int not null,
imagen text not null,
id_categoria varchar(50) not null
);

create table proveedor(
id_proveedor int(11) not null,
nombre_empresa varchar(50), not null,
telefono text not null,
email text not null,
productos text not null
);

create table cliente(
id_cliente int(11) not null,
nombre varchar (50)not null,
num_cliente int not null,
rfc varchar(13)not null,
correo text not null,
direccion varchar(255)
);

create table promocion(
id_promocion int(11) primary_key,
foto text
descripcion varchar
categoria
precio_promocion
);
