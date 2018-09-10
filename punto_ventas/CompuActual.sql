create table usuarios(
id int(11) primary key AUTO_INCREMENT,
nombre text 
usuario text 
password text
perfil text
foto text
estado int(11)
ultimo_login datetime
fecha	timestamp   
);
INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES (NULL, 'usuario administrador', 'Administrador', 'CompuActual', 'Administrador', '', '1', '', CURRENT_TIMESTAMP);