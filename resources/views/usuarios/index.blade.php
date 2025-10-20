<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Usuarios - StoreComputadores</title>
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
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto gap-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}">Productos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('usuarios.index') }}">Usuarios</a></li>
                    <li class="nav-item"><a class="btn btn-primary btn-sm" href="{{ route('usuarios.create') }}"><i class="fas fa-user-plus me-1"></i>Nuevo</a></li>
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

            <h1 class="mb-3">Usuarios</h1>

            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>Teléfono</th>
                                <th>Creado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usuarios as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td>
                                    <small class="text-muted d-block">{{ $u->tipo_documento }}</small>
                                    <span>{{ $u->numero_documento }}</span>
                                </td>
                                <td>{{ $u->nombre }} {{ $u->apellido }}</td>
                                <td>{{ $u->correo }}</td>
                                <td><span class="badge bg-secondary">{{ $u->rol }}</span></td>
                                <td>{{ $u->telefono ?? '—' }}</td>
                                <td>{{ optional($u->created_at)->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Acciones">
                                        <a href="{{ route('usuarios.show', $u->id) }}" class="btn btn-info" title="Ver"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('usuarios.edit', $u->id) }}" class="btn btn-warning" title="Editar"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Eliminar usuario?')" title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-user-slash fa-2x text-muted mb-2"></i>
                                    <p class="text-muted mb-2">No hay usuarios registrados</p>
                                    <a class="btn btn-primary btn-sm" href="{{ route('usuarios.create') }}">Registrar primero</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if(method_exists($usuarios, 'links'))
                    <div class="d-flex justify-content-center mt-3">
                        {{ $usuarios->links() }}
                    </div>
                    @endif
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