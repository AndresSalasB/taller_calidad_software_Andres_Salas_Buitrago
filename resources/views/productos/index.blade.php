<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lista de Productos</title>

    {{-- Favicon (ajusta la ruta si es necesario) --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/storeComputadores.jpeg') }}">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome (para los íconos de acciones) --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- CSRF meta por si lo necesitas en JS --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #000 70%, #d90429 100%);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/storeComputadores.jpeg') }}" alt="Logo StoreComputadores"
                    width="48" height="48" class="rounded border border-danger">
                <span class="fw-semibold text-danger">TiendaComputadores</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Alternar navegación">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('inicio') ? 'active' : '' }}" href="{{ route('inicio') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.index') ? 'active' : '' }}" href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        {{-- Ajusta la ruta de categorías si la tienes definida --}}
                        <a class="nav-link" href="{{ route('productos.index') }}#categorias">Categorías</a>
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

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="flex-grow-1">
        <div class="container mt-4">

            {{-- Mensajes--}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
            @endif

            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-4">
                <h1 class="m-0">Lista de Productos</h1>
                <a href="{{ route('productos.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo Producto
                </a>
            </div>

            {{-- Tabla de productos --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th class="d-none d-md-table-cell">Descripción</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id }}</td>
                                    <td>{{ $producto->marca }}</td>
                                    <td>{{ $producto->modelo }}</td>
                                    <td class="d-none d-md-table-cell">
                                        {{ \Illuminate\Support\Str::limit($producto->descripcion, 60) }}
                                    </td>
                                    <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $producto->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                            {{ $producto->stock }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($producto->imagen)
                                        <img src="{{ asset('storage/' . $producto->imagen) }}"
                                            alt="{{ $producto->marca }}"
                                            class="rounded"
                                            style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                        <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                            {{-- Botón Consultar --}}
                                            <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-info" title="Consultar">
                                                <i class="fas fa-eye"></i>
                                                <span class="d-none d-md-inline ms-1">Consultar</span>
                                            </a>

                                            {{-- Editar --}}
                                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Eliminar --}}
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar producto?')" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-2">No hay productos registrados</p>
                                        <a href="{{ route('productos.create') }}" class="btn btn-primary btn-sm">
                                            Crear Primer Producto
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{--Paginación--}}
                    @if(method_exists($productos, 'links'))
                    <div class="d-flex justify-content-center mt-3">
                        {{ $productos->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
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

    {{-- Bootstrap JS--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{--Año--}}
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>

</body>

</html>