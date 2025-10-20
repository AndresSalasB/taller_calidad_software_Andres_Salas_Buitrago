<<<<<<< HEAD
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
=======
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> d9ab7c2 (Primer Commit)
