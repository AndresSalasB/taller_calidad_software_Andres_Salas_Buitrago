<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #000 70%, #d90429 100%);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="/">
            <img src="/Imagenes/storeComputadores.jpeg" alt="Logo StoreComputadores" width="90" height="90" class="rounded border border-danger">
            <span class="fs-1 fw-semibold text-danger">StoreComputadores</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Alternar navegación">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="mainNav" class="collapse navbar-collapse">
            {{-- Slot opcional para inyectar items adicionales desde la vista --}}
            {{ $slot }}

            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">

                {{-- Si estamos en la página de inicio, los enlaces deben ser anclas para hacer scroll; en otras páginas usan rutas nombradas --}}
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ request()->routeIs('inicio') ? '#inicio' : route('inicio') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ request()->routeIs('inicio') ? '#productos' : route('productos.index') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ request()->routeIs('inicio') ? '#categorias' : route('productos.index') }}">Categorías</a>
                </li>
                <li class="nav-item"><a class="nav-link text-danger" href="{{ route('login') }}">Iniciar Sesión</a></li>

                @auth
                @php($user = auth()->user())
                <li class="nav-item dropdown" id="miPanelDropdownWrapper">
                    <a id="miPanelToggle" class="btn btn-light text-danger fw-semibold px-3 dropdown-toggle"
                        href="#" data-bs-toggle="dropdown" aria-expanded="false" role="button"
                        autocomplete="off">
                        Mi Panel ({{ $user->rol }})
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @if ($user->isCliente())
                        <li><a class="dropdown-item text-danger" href="{{ route('cliente.panel') }}">Panel Cliente</a></li>
                        @endif
                        @if ($user->isGerente() || $user->isAdmin())
                        <li><a class="dropdown-item text-danger" href="{{ route('gerente.panel') }}">Panel Gerente</a></li>
                        @endif
                        @if ($user->isAdmin())
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
<script>
    // Fallback específico: si al hacer click no se abre, instanciamos y togglamos manualmente.
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('miPanelToggle');
        if (!toggle) return;
        toggle.addEventListener('click', (e) => {
            // Si Bootstrap ya lo maneja, no interferimos; detectamos si el hermano no tiene clase show tras un tick.
            setTimeout(() => {
                const menu = toggle.parentElement.querySelector('.dropdown-menu');
                if (!menu.classList.contains('show')) {
                    if (window.bootstrap && bootstrap.Dropdown) {
                        let inst = bootstrap.Dropdown.getInstance(toggle);
                        if (!inst) inst = new bootstrap.Dropdown(toggle);
                        inst.toggle();
                    } else {
                        // Degradado: alternar manualmente clases básicas
                        menu.classList.toggle('show');
                        toggle.setAttribute('aria-expanded', menu.classList.contains('show') ?
                            'true' : 'false');
                    }
                }
            }, 40); // pequeño delay para dejar actuar a Bootstrap si está operativo
        });
    });
</script>