<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle de Producto - StoreComputadores</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/storeComputadores.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR (mismo estilo que index/create) --}}
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #000 70%, #d90429 100%);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/storeComputadores.jpg') }}" alt="Logo StoreComputadores"
                    width="48" height="48" class="rounded border border-danger">
                <span class="fw-semibold text-danger">StoreComputadores</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Alternar navegación">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    @endguest
                    @auth
                    @php($user = auth()->user())
                    <li class="nav-item dropdown">
                        <a class="btn btn-light text-danger fw-semibold px-3 dropdown-toggle"
                            href="#" id="miPanelToggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Mi Panel ({{ $user->rol ?? 'Usuario' }})
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="miPanelToggle">
                            @if (method_exists($user, 'isCliente') && $user->isCliente())
                            <li><a class="dropdown-item text-danger" href="{{ route('cliente.panel') }}">Panel Cliente</a></li>
                            @endif
                            @if ((method_exists($user, 'isGerente') && $user->isGerente()) || (method_exists($user, 'isAdmin') && $user->isAdmin()))
                            <li><a class="dropdown-item text-danger" href="{{ route('gerente.panel') }}">Panel Gerente</a></li>
                            @endif
                            @if (method_exists($user, 'isAdmin') && $user->isAdmin())
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

    {{-- CONTENIDO --}}
    <main class="flex-grow-1">
        <div class="container mt-4">

            {{-- Migas + acciones superiores --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
            @endif

            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                <h1 class="m-0">Detalle del Producto</h1>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('¿Eliminar este producto?')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>

            {{-- CARD detalle --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row g-4">
                        {{-- Imagen grande --}}
                        <div class="col-12 col-lg-4 text-center">
                            @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}"
                                alt="{{ $producto->marca . ' ' . $producto->modelo }}"
                                class="rounded border"
                                style="max-width: 100%; height: auto; object-fit: cover;">
                            @else
                            <div class="border rounded d-flex align-items-center justify-content-center"
                                style="width: 100%; min-height: 220px;">
                                <span class="text-muted"><i class="fas fa-image me-2"></i>Sin imagen</span>
                            </div>
                            @endif
                        </div>

                        {{-- Datos principales --}}
                        <div class="col-12 col-lg-8">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="h4 mb-3">{{ $producto->marca }} {{ $producto->modelo }}</h2>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <small class="text-muted d-block">ID</small>
                                    <span class="fw-semibold">{{ $producto->id }}</span>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <small class="text-muted d-block">Precio</small>
                                    <span class="fw-semibold">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <small class="text-muted d-block">Stock</small>
                                    <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $producto->stock }}
                                    </span>
                                </div>

                                <div class="col-12 mb-3">
                                    <small class="text-muted d-block">Descripción</small>
                                    <p class="mb-0">{{ $producto->descripcion }}</p>
                                </div>

                                {{-- Metadatos opcionales si existen en tu modelo --}}
                                @if(!empty($producto->created_at) || !empty($producto->updated_at))
                                <div class="col-12">
                                    <hr>
                                    <div class="d-flex flex-wrap gap-3 text-muted small">
                                        @if(!empty($producto->created_at))
                                        <span><i class="far fa-clock me-1"></i>Creado: {{ $producto->created_at->format('d/m/Y H:i') }}</span>
                                        @endif
                                        @if(!empty($producto->updated_at))
                                        <span><i class="far fa-pen-to-square me-1"></i>Actualizado: {{ $producto->updated_at->format('d/m/Y H:i') }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    {{-- Acciones inferiores (duplicadas para comodidad en móviles) --}}
                    <div class="d-flex flex-wrap gap-2 justify-content-end">
                        <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Volver
                        </a>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Eliminar este producto?')">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>

    {{-- FOOTER (igual que index/create) --}}
    <footer class="bg-light border-top py-4 mt-auto">
        <div class="container">
            <ul class="nav justify-content-center gap-3">
                <li class="nav-item"><a class="nav-link text-muted" href="#">Acerca de</a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="#">Soporte</a></li>
                <li class="nav-item"><a class="nav-link text-muted" href="#">Contacto</a></li>
            </ul>
            <p class="text-center text-muted mb-0 mt-2 small">&copy; <span id="year"></span> StoreComputadores</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>