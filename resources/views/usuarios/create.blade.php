<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Registrar Usuario - StoreComputadores</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/storeComputadores.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR (mismo estilo que productos) --}}
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #000 70%, #d90429 100%);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/storeComputadores.jpg') }}" alt="Logo StoreComputadores"
                    width="48" height="48" class="rounded border border-danger">
                <span class="fw-semibold text-danger">StoreComputadores</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item"><a class="nav-link" href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('productos.index') }}">Productos</a></li>
                    <li class="nav-item"><a class="nav-link active" href="{{ route('usuarios.create') }}">Registrar usuario</a></li>
                    @guest
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm" href="{{ route('login') }}">Iniciar Sesión</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main class="flex-grow-1">
        <div class="container mt-4">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Registrar</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                <h1 class="m-0">Registrar Usuario</h1>
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Volver a la lista
                </a>
            </div>

            {{-- Errores globales --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Revisa los siguientes errores:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('usuarios.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="row g-3">
                            {{-- Tipo Documento (enum exacto) --}}
                            <div class="col-md-6">
                                <label for="tipo_documento" class="form-label">Tipo de documento</label>
                                <select id="tipo_documento" name="tipo_documento"
                                    class="form-select @error('tipo_documento') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('tipo_documento') ? '' : 'selected' }}>Seleccione...</option>
                                    @foreach([
                                    'Cédula de Ciudadania',
                                    'Cédula de Extranjería',
                                    'Tarjeta de Identidad',
                                    'Pasaporte',
                                    'NIT'
                                    ] as $td)
                                    <option value="{{ $td }}" {{ old('tipo_documento') === $td ? 'selected' : '' }}>
                                        {{ $td }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('tipo_documento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Número de documento --}}
                            <div class="col-md-6">
                                <label for="numero_documento" class="form-label">Número de documento</label>
                                <input type="text" id="numero_documento" name="numero_documento"
                                    value="{{ old('numero_documento') }}"
                                    class="form-control @error('numero_documento') is-invalid @enderror"
                                    maxlength="30" required>
                                @error('numero_documento') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Nombre / Apellido --}}
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre"
                                    value="{{ old('nombre') }}"
                                    class="form-control @error('nombre') is-invalid @enderror"
                                    maxlength="50" required>
                                @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" id="apellido" name="apellido"
                                    value="{{ old('apellido') }}"
                                    class="form-control @error('apellido') is-invalid @enderror"
                                    maxlength="50" required>
                                @error('apellido') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Correo --}}
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" id="correo" name="correo"
                                    value="{{ old('correo') }}"
                                    class="form-control @error('correo') is-invalid @enderror"
                                    maxlength="160" required>
                                @error('correo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Teléfono (opcional) --}}
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono (opcional)</label>
                                <input type="text" id="telefono" name="telefono"
                                    value="{{ old('telefono') }}"
                                    class="form-control @error('telefono') is-invalid @enderror"
                                    maxlength="20">
                                @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Rol (enum exacto) --}}
                            <div class="col-md-6">
                                <label for="rol" class="form-label">Rol</label>
                                <select id="rol" name="rol"
                                    class="form-select @error('rol') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('rol') ? '' : 'selected' }}>Seleccione...</option>
                                    @foreach(['Administrador','Cliente','Gerente'] as $r)
                                    <option value="{{ $r }}" {{ old('rol') === $r ? 'selected' : '' }}>{{ $r }}</option>
                                    @endforeach
                                </select>
                                @error('rol') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Password + confirmación --}}
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    minlength="8" required>
                                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                <div class="form-text">Mínimo 8 caracteres.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                    class="form-control" minlength="8" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i> Registrar usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    {{-- FOOTER (igual estilo) --}}
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