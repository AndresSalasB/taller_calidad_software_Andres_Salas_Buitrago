<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>TiendaComputadores - Venta de Equipos de Cómputo</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/storeComputadores.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-red: #d90429;
            --dark-bg: #000;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .hero-section {
            background: linear-gradient(135deg, #000 0%, #d90429 100%);
            color: #fff;
            padding: 5rem 0;
        }

        .hero-img {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .3);
            max-height: 400px;
            object-fit: cover;
        }

        .btn-red {
            background-color: var(--primary-red);
            border-color: var(--primary-red);
            color: #fff;
        }

        .btn-red:hover {
            background-color: #b00322;
            border-color: #b00322;
            color: #fff;
        }

        .btn-outline-red {
            border-color: var(--primary-red);
            color: var(--primary-red);
        }

        .btn-outline-red:hover {
            background-color: var(--primary-red);
            color: #fff;
        }

        .categories-section {
            background-color: var(--light-bg);
        }

        .category-card,
        .product-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
            transition: transform .3s ease;
        }

        .category-card:hover,
        .product-card:hover {
            transform: translateY(-5px);
        }

        .icon-container {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bg-red {
            background-color: var(--primary-red);
        }

        .text-red {
            color: var(--primary-red) !important;
        }

        .products-section {
            background-color: #fff;
        }

        .filter-card {
            background: linear-gradient(90deg, #000 70%, #d90429 100%);
            border-radius: 10px;
            border: none;
        }

        .badge-portatil {
            background-color: var(--primary-red);
            color: #fff;
        }

        .badge-escritorio {
            background-color: var(--dark-bg);
            color: #fff;
        }

        .cta-section {
            background: linear-gradient(90deg, #000 70%, #d90429 100%);
            color: #fff;
        }

        .cta-btn {
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 600;
        }

        .navbar {
            background: linear-gradient(90deg, #000 70%, #d90429 100%) !important;
        }

        footer {
            background-color: var(--light-bg);
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/storeComputadores.jpeg') }}" alt="Logo TiendaComputadores" width="56" height="56" class="rounded border border-danger">
                <span class="fw-semibold text-danger">TiendaComputadores</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Alternar navegación">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item"><a class="nav-link text-white" href="#inicio">Inicio</a></li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('tiposProducto.index') }}">Categorías</a>
                    </li>

                    {{-- Botones Auth --}}
                    @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm {{ request()->routeIs('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light btn-sm text-danger ms-lg-2 {{ request()->routeIs('registro') ? 'active' : '' }}"
                            href="{{ route('registro') }}">
                            <i class="fas fa-user-plus me-1"></i> Registrarse
                        </a>
                    </li>
                    @endguest

                    @auth
                    @php($user = auth()->user())
                    <li class="nav-item dropdown" id="miPanelDropdownWrapper">
                        <a id="miPanelToggle" class="btn btn-light text-danger fw-semibold px-3 dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" role="button" autocomplete="off">
                            Mi Panel ({{ $user->rol ?? 'Usuario' }})
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            {{-- Perfil propio (show/edit) --}}
                            <li><a class="dropdown-item text-danger" href="{{ route('usuarios.show', $user->id) }}"><i class="far fa-id-card me-2"></i>Mi Perfil</a></li>
                            <li><a class="dropdown-item text-danger" href="{{ route('usuarios.edit', $user->id) }}"><i class="fas fa-user-pen me-2"></i>Editar Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            {{-- Listado general de usuarios (si tiene permiso) --}}
                            @auth
                            @can('manage-users')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a>
                            </li>
                            @endcan
                            @endauth

                            {{-- Paneles por rol (si existen las rutas) --}}
                            @if (Route::has('cliente.panel') && $user->rol === 'Cliente')
                            <li><a class="dropdown-item text-danger" href="{{ route('cliente.panel') }}">Panel Cliente</a></li>
                            @endif
                            @if (Route::has('gerente.panel') && $user->rol === 'Gerente')
                            <li><a class="dropdown-item text-danger" href="{{ route('gerente.panel') }}">Panel Gerente</a></li>
                            @endif
                            @if (Route::has('admin.panel') && $user->rol === 'Administrador')
                            <li><a class="dropdown-item text-danger" href="{{ route('admin.panel') }}">Administración</a></li>
                            @endif

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="px-3 py-1">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-grow-1 d-flex flex-column">

        {{-- HERO --}}
        <section id="inicio" class="hero-section py-5">
            <div class="container">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <h1 class="display-5 fw-bold lh-sm">Bienvenido a <span class="text-white">TiendaComputadores</span></h1>
                        <p class="lead mt-3">Encuentra los mejores computadores de escritorio y portátiles con precios increíbles y la mejor calidad.</p>
                        <div class="d-flex gap-3 mt-4">
                            <a href="{{ route('productos.index') }}" class="btn btn-danger btn-lg">Ver Catálogo</a>
                            @guest
                            <a href="{{ route('usuarios.create') }}" class="btn btn-outline-light btn-lg">Registrarse</a>
                            @else
                            <a href="{{ route('usuarios.show', auth()->id()) }}" class="btn btn-outline-light btn-lg">Mi Perfil</a>
                            @endguest
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('imagenes/storeComputadores.jpeg') }}" alt="Computadores de última generación" class="img-fluid hero-img">
                    </div>
                </div>
            </div>
        </section>

        {{-- CATEGORÍAS
        <section id="categorias" class="categories-section py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark mb-3">Nuestras Categorías</h2>
                    <p class="text-muted">Descubre nuestro amplio catálogo de productos tecnológicos</p>
                </div>

                <div class="row g-4">
                    {{-- Portátiles
                    <div class="col-md-6">
                        <div class="card h-100 category-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-container bg-red mx-auto mb-3"><i class="fas fa-laptop text-white"></i></div>
                                <h3 class="h4 fw-bold text-dark mb-3">Computadores Portátiles</h3>
                                <p class="text-muted mb-4">Laptops de alto rendimiento para trabajo, estudio y gaming.</p>
                                <a href="{{ route('productos.index') }}#portatiles" class="btn btn-outline-red" data-tipo="portatil">Ver Portátiles</a>
        </div>
        </div>
        </div>

        {{-- Escritorio
                    <div class="col-md-6">
                        <div class="card h-100 category-card">
                            <div class="card-body text-center p-4">
                                <div class="icon-container bg-dark mx-auto mb-3"><i class="fas fa-desktop text-white"></i></div>
                                <h3 class="h4 fw-bold text-dark mb-3">Computadores de Escritorio</h3>
                                <p class="text-muted mb-4">PCs potentes para oficina, hogar y gaming.</p>
                                <a href="{{ route('productos.index') }}#escritorio" class="btn btn-outline-dark" data-tipo="escritorio">Ver de Escritorio</a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </section>--}}

        {{-- CATÁLOGO DE PRODUCTOS --}}

        {{-- LISTADO (DEMO)
        <section id="productos" class="products-section py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="fw-bold text-dark mb-3">Catálogo de Computadores</h2>
                    <p class="text-muted">Los mejores equipos al mejor precio</p>
                </div> --}}

        {{-- Filtros demo
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card filter-card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h5 class="mb-0 text-white">Filtrar por Tipo:</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select" id="filtroTipo">
                                            <option value="todos">Todos los productos</option>
                                            <option value="portatil">Portátiles</option>
                                            <option value="escritorio">Computadores de Escritorio</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}

        {{-- Grid demo (estático) --}}
        <div class="row g-4" id="gridProductos">
            <div class="col-lg-4 col-md-6" data-tipo="portatil">
                <div class="card h-100 product-card">
                    <div class="position-relative">
                        <img src="{{ asset('imagenes/computadorPortatil.jpg') }}" class="card-img-top" alt="Laptop Gaming" style="height:200px; object-fit:cover;">
                        <span class="position-absolute top-0 start-0 m-2 badge badge-portatil">Portátil</span>
                        <span class="position-absolute top-0 end-0 m-2 badge bg-success">En Stock</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-dark">Laptop Gaming</h5>
                        <p class="card-text text-muted small flex-grow-1">RTX, 16GB RAM, 1TB SSD.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <h4 class="text-red fw-bold mb-0">$4.299.000</h4>
                            @guest
                            {{--<a class="btn btn-red btn-sm" href="{{ route('login') }}">Agregar al Carrito</a>--}}
                            @else
                            {{--<button class="btn btn-red btn-sm" type="button">Agregar al Carrito</button>--}}
                            @endguest
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-tipo="escritorio">
                <div class="card h-100 product-card">
                    <div class="position-relative">
                        <img src="{{ asset('imagenes/computadorEscritorio.webp') }}" class="card-img-top" alt="PC Escritorio" style="height:200px; object-fit:cover;">
                        <span class="position-absolute top-0 start-0 m-2 badge badge-escritorio">Escritorio</span>
                        <span class="position-absolute top-0 end-0 m-2 badge bg-success">En Stock</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-dark">PC de Escritorio</h5>
                        <p class="card-text text-muted small flex-grow-1">i7, 32GB RAM, 2TB SSD.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <h4 class="text-red fw-bold mb-0">$5.799.000</h4>
                            @guest
                            {{--<a class="btn btn-red btn-sm" href="{{ route('login') }}">Agregar al Carrito</a>
                            @else
                            <button class="btn btn-red btn-sm" type="button">Agregar al Carrito</button>--}}
                            @endguest
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6" data-tipo="portatil">
                <div class="card h-100 product-card">
                    <div class="position-relative">
                        <img src="{{ asset('imagenes/computadorAiO.webp') }}" class="card-img-top" alt="Ultrabook" style="height:200px; object-fit:cover;">
                        <span class="position-absolute top-0 start-0 m-2 badge badge-portatil">Portátil</span>
                        <span class="position-absolute top-0 end-0 m-2 badge bg-warning">Últimas unidades</span>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-dark">Ultrabook</h5>
                        <p class="card-text text-muted small flex-grow-1">Pantalla 13”, i5, 8GB RAM.</p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <h4 class="text-red fw-bold mb-0">$3.899.000</h4>
                            @guest
                            {{--<a class="btn btn-red btn-sm" href="{{ route('login') }}">Agregar al Carrito</a>
                            @else
                            <button class="btn btn-red btn-sm" type="button">Agregar al Carrito</button>--}}
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- accesos directos a CRUD Usuarios (útiles para pruebas) --}}
        <div class="text-center mt-5">
            <div class="d-inline-flex gap-2 flex-wrap">
                {{--<a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary"><i class="fas fa-users me-2"></i>Listado de Usuarios</a>
                <a href="{{ route('usuarios.create') }}" class="btn btn-primary"><i class="fas fa-user-plus me-2"></i>Registrar Usuario</a>--}}
                @auth
                <a href="{{ route('usuarios.show', auth()->id()) }}" class="btn btn-info"><i class="far fa-id-card me-2"></i>Mi Perfil</a>
                <a href="{{ route('usuarios.edit', auth()->id()) }}" class="btn btn-warning"><i class="fas fa-user-pen me-2"></i>Editar Mi Perfil</a>
                @endauth
            </div>
        </div>

        </div>
        </section>

        {{-- CTA --}}
        <section class="cta-section py-5">
            <div class="container">
                <div class="row align-items-center">
                    {{--
                    <div class="col-lg-8">
                        <h2 class="fw-bold mb-3">¿Eres vendedor de computadores?</h2>
                        <p class="lead mb-0">Únete a nuestra plataforma y llega a miles de clientes interesados en tecnología.</p>
                    </div>--}}
                    <div class="col-lg-4 text-lg-end">
                        @guest
                        <a href="{{ route('usuarios.create') }}" class="btn btn-light btn-lg cta-btn">Registrarme</a>
                        @else
                        <a href="{{ route('productos.index') }}" class="btn btn-light btn-lg cta-btn">Publicar productos</a>
                        @endguest
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-light border-top py-4 mt-auto">
        <div class="container">
            <ul class="nav justify-content-center gap-3">
                <li class="nav-item"><a class="nav-link text-muted" href="#">Acerca de</a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="#">Soporte</a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="#">Contacto</a></li>
            </ul>
            <p class="text-center text-muted mb-0 mt-2 small">&copy; <span id="year"></span> TiendaComputadores</p>
        </div>
    </footer>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Año dinámico
        document.getElementById('year').textContent = new Date().getFullYear();

        // Filtro de productos (demo)
        const filtro = document.getElementById('filtroTipo');
        if (filtro) {
            filtro.addEventListener('change', function() {
                const tipo = this.value;
                document.querySelectorAll('#gridProductos > div').forEach(card => {
                    card.style.display = (tipo === 'todos' || card.getAttribute('data-tipo') === tipo) ? 'block' : 'none';
                });
            });
        }

        // Filtro desde botones de categorías (demo)
        document.querySelectorAll('[data-tipo]').forEach(el => {
            el.addEventListener('click', function(e) {
                if (this.tagName === 'A' && this.getAttribute('href').includes('#')) e.preventDefault();
                const tipo = this.getAttribute('data-tipo');
                if (filtro) {
                    filtro.value = tipo;
                    filtro.dispatchEvent(new Event('change'));
                }
                const productos = document.getElementById('productos');
                if (productos) productos.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>