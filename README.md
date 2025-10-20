# taller_calidad_software_Andres_Salas

Documentación de Funcionalidades - Aplicación Web "Tienda Computadores"
La aplicación web Tienda Computadores está diseñada para la venta de diferentes tipos de computadores, tanto portátiles como de escritorio. Su objetivo principal es ofrecer una plataforma funcional y eficiente para la gestión de productos y usuarios, integrando un sistema de roles que facilita la administración del negocio.
Estructura de la Base de Datos
La base de datos utilizada es MySQL y cuenta con tres tablas principales: Usuarios, Productos y Tipos de Computadores.
Tabla: Usuarios
La tabla de usuarios contiene la información de los distintos perfiles que acceden al sistema. Existen tres roles definidos con permisos específicos:
• Rol Administrador: Tiene acceso completo al sistema, incluyendo la creación, edición y eliminación de usuarios y productos.
• Rol Gerente: Puede crear usuarios y gestionar los computadores disponibles para la venta, incluyendo su descripción e imagen.
• Rol Cliente: Puede registrarse, iniciar sesión y consultar los diferentes tipos de computadores disponibles en la tienda.
Tabla: Productos
La tabla de productos almacena la información de cada computador disponible para la venta. Sus campos principales son los siguientes:
• Marca
• Modelo
• Descripción
• Precio
• Imagen
• Tipo de Computador (relacionado con la tabla Tipos de Computadores)
Tabla: Tipos de Computadores
La tabla de tipos de computadores permite clasificar los diferentes productos según su categoría. Existe una relación de uno a muchos entre esta tabla y la tabla de productos, es decir, un tipo de computador puede estar asociado a varios productos.
Funcionalidades por Rol
A continuación, se detallan las principales funcionalidades disponibles según el rol del usuario en el sistema:
• Administrador:
  - Crear, editar y eliminar usuarios.
  - Crear, editar y eliminar productos.
  - Gestionar tipos de computadores.
  - Supervisar la actividad general del sistema.

• Gerente:
  - Crear nuevos usuarios.
  - Crear y actualizar la información de los computadores disponibles.

• Cliente:
  - Registrarse en la plataforma.
  - Consultar y visualizar los computadores disponibles.

TECNOLOGIAS UTILIZADAS 
Front-End:
Se aplicará la lógica de la aplicación en código PHP con la ayuda de un Framework Laravel 
Back-End:
Se aplicará el diseño de las interfaces de Usuario con herramientas HTML y CSS y ayuda de Framework Bootstrap para aplicar un estilo más vistoso y que sea responsive a varios navegadores web y/o dispositivos.
DataBase:
Se utilizará el Servidor de base de datos MySQL junto al gestor de base de datos Xampp integrado con Workbench
