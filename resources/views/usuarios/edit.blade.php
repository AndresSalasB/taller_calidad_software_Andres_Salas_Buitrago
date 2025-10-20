<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Usuario - StoreComputadores</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/storeComputadores.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Revisa los siguientes errores:</strong>
                <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                <h1 class="m-0">Editar Usuario</h1>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-info"><i class="fas fa-eye"></i> Ver detalle</a>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" novalidate>
                        @csrf @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="tipo_documento">Tipo de documento</label>
                                <select id="tipo_documento" name="tipo_documento" class="form-select @error('tipo_documento') is-invalid @enderror" required>
                                    @foreach([
                                    'Cédula de Ciudadania',
                                    'Cédula de Extranjería',
                                    'Tarjeta de Identidad',
                                    'Pasaporte',
                                    'NIT'
                                    ] as $td)
                                    <option value="{{ $td }}" {{ old('tipo_documento', $usuario->tipo_documento) === $td ? 'selected' : '' }}>{{ $td }}</option>
                                    @endforeach
                                </select>
                                @error('tipo_documento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="numero_documento">Número de documento</label>
                                <input id="numero_documento" name="numero_documento" type="text"
                                    value="{{ old('numero_documento', $usuario->numero_documento) }}"
                                    class="form-control @error('numero_documento') is-invalid @enderror" maxlength="30" required>
                                @error('numero_documento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="nombre">Nombre</label>
                                <input id="nombre" name="nombre" type="text"
                                    value="{{ old('nombre', $usuario->nombre) }}"
                                    class="form-control @error('nombre') is-invalid @enderror" maxlength="50" required>
                                @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="apellido">Apellido</label>
                                <input id="apellido" name="apellido" type="text"
                                    value="{{ old('apellido', $usuario->apellido) }}"
                                    class="form-control @error('apellido') is-invalid @enderror" maxlength="50" required>
                                @error('apellido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="correo">Correo</label>
                                <input id="correo" name="correo" type="email"
                                    value="{{ old('correo', $usuario->correo) }}"
                                    class="form-control @error('correo') is-invalid @enderror" maxlength="160" required>
                                @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="telefono">Teléfono (opcional)</label>
                                <input id="telefono" name="telefono" type="text"
                                    value="{{ old('telefono', $usuario->telefono) }}"
                                    class="form-control @error('telefono') is-invalid @enderror" maxlength="20">
                                @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="rol">Rol</label>
                                <select id="rol" name="rol" class="form-select @error('rol') is-invalid @enderror" required>
                                    @foreach(['Administrador','Cliente','Gerente'] as $r)
                                    <option value="{{ $r }}" {{ old('rol', $usuario->rol) === $r ? 'selected' : '' }}>{{ $r }}</option>
                                    @endforeach
                                </select>
                                @error('rol') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="password">Nueva contraseña (opcional)</label>
                                <input id="password" name="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" minlength="8">
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="form-text">Déjala vacía si no deseas cambiarla.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" minlength="8">
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-eye"></i> Ver detalle
                            </a>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Actualizar
                            </button>
                        </div>
                    </form>
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