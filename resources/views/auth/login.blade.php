<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Iniciar Sesión - TiendaComputadores</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/storeComputadores.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .navbar {
            background: linear-gradient(90deg, #000 70%, #d90429 100%);
        }

        .btn-red {
            background-color: #d90429;
            border-color: #d90429;
            color: #fff;
        }

        .btn-red:hover {
            background-color: #b00322;
            border-color: #b00322;
            color: #fff;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVBAR (mismo estilo que inicio) --}}
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('inicio') }}">
                <img src="{{ asset('imagenes/storeComputadores.jpeg') }}" alt="Logo TiendaComputadores"
                    width="48" height="48" class="rounded border border-danger">
                <span class="fw-semibold text-danger">TiendaComputadores</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div id="mainNav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}"
                            href="{{ route('productos.index') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-red btn-sm" href="{{ route('registro') }}">
                            <i class="fas fa-user-plus me-1"></i> Registrarse
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENIDO --}}
    <main class="flex-grow-1">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-6">

                    {{-- Flash --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                    </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h1 class="h4 mb-4 text-center">Iniciar Sesión</h1>

                            {{-- Errores de validación --}}
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            {{-- IMPORTANTE: solo backend (DB). Sin autenticación en JS. --}}
                            <form id="loginForm" action="{{ route('login.perform') }}" method="POST" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="correo" class="form-label">Correo</label>
                                    <input type="email" id="correo" name="correo"
                                        class="form-control @error('correo') is-invalid @enderror"
                                        value="{{ old('correo') }}" required autofocus>
                                    @error('correo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" required>
                                        <button type="button" class="btn btn-outline-secondary" id="togglePwd" tabindex="-1"
                                            aria-label="Mostrar/Ocultar contraseña">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Recordarme</label>
                                </div>

                                <div class="d-grid gap-2">
                                    <button id="submitBtn" type="submit" class="btn btn-primary">
                                        <span class="btn-text">
                                            <i class="fas fa-right-to-bracket me-1"></i> Entrar
                                        </span>
                                        <span class="btn-spinner d-none">
                                            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                            Enviando...
                                        </span>
                                    </button>
                                    <a href="{{ route('registro') }}" class="btn btn-outline-secondary">
                                        ¿No tienes cuenta? Regístrate
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-light border-top py-4 mt-auto">
        <div class="container">
            <p class="text-center text-muted mb-0 small">&copy; <span id="year"></span> TiendaComputadores</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Año dinámico
        document.getElementById('year').textContent = new Date().getFullYear();

        // UX: mostrar/ocultar contraseña
        document.getElementById('togglePwd')?.addEventListener('click', function() {
            const pwd = document.getElementById('password');
            const icon = this.querySelector('i');
            if (!pwd) return;
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon?.classList.remove('fa-eye');
                icon?.classList.add('fa-eye-slash');
            } else {
                pwd.type = 'password';
                icon?.classList.remove('fa-eye-slash');
                icon?.classList.add('fa-eye');
            }
        });

        // UX: evitar doble envío y mostrar spinner; NO valida credenciales en front-end
        (function() {
            const form = document.getElementById('loginForm');
            const btn = document.getElementById('submitBtn');
            if (!form || !btn) return;

            form.addEventListener('submit', function() {
                btn.disabled = true;
                btn.querySelector('.btn-text')?.classList.add('d-none');
                btn.querySelector('.btn-spinner')?.classList.remove('d-none');
            });
        })();
    </script>
</body>

</html>