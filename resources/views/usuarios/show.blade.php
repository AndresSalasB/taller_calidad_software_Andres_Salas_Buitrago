<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detalle Usuario - StoreComputadores</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/storeComputadores.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #000 70%, #d90429 100%);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/storeComputadores.jpg') }}" width="48" height="48" class="rounded border border-danger" alt="">
                <span class="fw-semibold text-danger">StoreComputadores</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}">Productos</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        <div class="container mt-4">

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detalle</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                <h1 class="m-0">Detalle del Usuario</h1>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar este usuario?')">
                            <i class="fas fa-trash"></i> Eliminar
                        </button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Nombre completo</small>
                            <span class="fw-semibold">{{ $usuario->nombre }} {{ $usuario->apellido }}</span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Rol</small>
                            <span class="badge bg-secondary">{{ $usuario->rol }}</span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Tipo/Número documento</small>
                            <span>{{ $usuario->tipo_documento }} — {{ $usuario->numero_documento }}</span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Correo</small>
                            <span>{{ $usuario->correo }}</span>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Teléfono</small>
                            <span>{{ $usuario->telefono ?? '—' }}</span>
                        </div>
                        <div class="col-12">
                            <hr>
                            <div class="d-flex flex-wrap gap-3 text-muted small">
                                @if($usuario->created_at) <span><i class="far fa-clock me-1"></i>Creado: {{ $usuario->created_at->format('d/m/Y H:i') }}</span>@endif
                                @if($usuario->updated_at) <span><i class="far fa-pen-to-square me-1"></i>Actualizado: {{ $usuario->updated_at->format('d/m/Y H:i') }}</span>@endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <footer class="bg-light border-top py-4 mt-auto">
        <div class="container">
            <p class="text-center text-muted mb-0 small">&copy; <span id="year"></span> StoreComputadores</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();
    </script>
</body>

</html>