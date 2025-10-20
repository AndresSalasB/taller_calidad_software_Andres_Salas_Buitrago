<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crear Producto - TiendaComputadores</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/storeComputadores.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR--}}
    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #000 70%, #d90429 100%);">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/storeComputadores.jpeg') }}" alt="Logo TiendaComputadores"
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

            {{--título--}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('productos.index') }}">Productos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
                <h1 class="m-0">Nuevo Producto</h1>
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Volver a la lista
                </a>
            </div>

            {{-- Errores--}}
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

            {{--formulario--}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="row g-3">
                            {{--Marca--}}
                            <div class="col-md-6">
                                <label for="marca" class="form-label">Marca</label>
                                <input
                                    type="text"
                                    id="marca"
                                    name="marca"
                                    value="{{ old('marca') }}"
                                    class="form-control @error('marca') is-invalid @enderror"
                                    placeholder="Ej: Lenovo, HP, Asus"
                                    required>
                                @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{--Modelo--}}
                            <div class="col-md-6">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input
                                    type="text"
                                    id="modelo"
                                    name="modelo"
                                    value="{{ old('modelo') }}"
                                    class="form-control @error('modelo') is-invalid @enderror"
                                    placeholder="Ej: IdeaPad 3, Pavilion 15"
                                    required>
                                @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{--Descripción--}}
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea
                                    id="descripcion"
                                    name="descripcion"
                                    rows="4"
                                    class="form-control @error('descripcion') is-invalid @enderror"
                                    placeholder="Resumen del producto, características principales...">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{--Precio--}}
                            <div class="col-md-6">
                                <label for="precio" class="form-label">Precio</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input
                                        type="number"
                                        id="precio"
                                        name="precio"
                                        value="{{ old('precio') }}"
                                        class="form-control @error('precio') is-invalid @enderror"
                                        step="0.01" min="0"
                                        placeholder="0.00" required>
                                    @error('precio')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Usa punto para decimales. Ej: 1499999.99</div>
                            </div>

                            {{--Stock--}}
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock</label>
                                <input
                                    type="number"
                                    id="stock"
                                    name="stock"
                                    value="{{ old('stock', 0) }}"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    min="0" step="1" required>
                                @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{--Imagen--}}
                            <div class="col-md-6">
                                <label for="imagen" class="form-label">Imagen (opcional)</label>
                                <input
                                    class="form-control @error('imagen') is-invalid @enderror"
                                    type="file" id="imagen" name="imagen" accept="image/*">
                                @error('imagen')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Formatos: JPG, PNG, WEBP. Máx. recomendado 2–3 MB.</div>
                            </div>

                            {{--Vista previa--}}
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="d-flex gap-3 align-items-center w-100">
                                    <img id="preview" src="#" alt="Vista previa"
                                        class="rounded border d-none"
                                        style="width: 100px; height: 100px; object-fit: cover;">
                                    <span id="previewText" class="text-muted">Sin imagen seleccionada</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Guardar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    {{--FOOTER--}}
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

    {{-- JS Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JS año--}}
    <script>
        document.getElementById('year').textContent = new Date().getFullYear();

        const inputImagen = document.getElementById('imagen');
        const preview = document.getElementById('preview');
        const previewText = document.getElementById('previewText');

        inputImagen?.addEventListener('change', (e) => {
            const file = e.target.files && e.target.files[0];
            if (!file) {
                preview.classList.add('d-none');
                previewText.textContent = 'Sin imagen seleccionada';
                return;
            }
            const url = URL.createObjectURL(file);
            preview.src = url;
            preview.classList.remove('d-none');
            previewText.textContent = 'Vista previa';
        });
    </script>
</body>

</html>