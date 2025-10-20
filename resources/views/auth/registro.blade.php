<x-app-layout>
    <x-navbar-layout>
        {{-- Slot vacío para el navbar --}}
    </x-navbar-layout>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-dark text-white text-center py-4">
                        <h4 class="mb-0">
                            Registrarse como {{ ucfirst($tipo) }}
                        </h4>
                    </div>
                    <div class="card-body p-5">
                        <x-flash-messages />

                        <form method="POST" action="{{ route('registro.submit') }}">
                            @csrf

                            <input type="hidden" name="rol" value="{{ ucfirst($tipo) }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                                        <select class="form-select @error('tipo_documento') is-invalid @enderror"
                                            id="tipo_documento" name="tipo_documento" required>
                                            <option value="">Seleccionar...</option>
                                            <option value="Cédula de Ciudadania" {{ old('tipo_documento') == 'Cédula de Ciudadania' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                                            <option value="Cédula de Extranjería" {{ old('tipo_documento') == 'Cédula de Extranjería' ? 'selected' : '' }}>Cédula de Extranjería</option>
                                            <option value="Tarjeta de Identidad" {{ old('tipo_documento') == 'Tarjeta de Identidad' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                                            <option value="Pasaporte" {{ old('tipo_documento') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                            <option value="NIT" {{ old('tipo_documento') == 'NIT' ? 'selected' : '' }}>NIT</option>
                                        </select>
                                        @error('tipo_documento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="numero_documento" class="form-label">Número de Documento</label>
                                        <input type="text" class="form-control @error('numero_documento') is-invalid @enderror"
                                            id="numero_documento" name="numero_documento" value="{{ old('numero_documento') }}" required>
                                        @error('numero_documento')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control @error('correo') is-invalid @enderror"
                                    id="correo" name="correo" value="{{ old('correo') }}" required>
                                @error('correo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"
                                            id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                        @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <input type="text" class="form-control @error('apellido') is-invalid @enderror"
                                            id="apellido" name="apellido" value="{{ old('apellido') }}" required>
                                        @error('apellido')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono (Opcional)</label>
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror"
                                    id="telefono" name="telefono" value="{{ old('telefono') }}">
                                @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required>
                                        @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                        <input type="password" class="form-control"
                                            id="password_confirmation" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-danger btn-lg">Crear Cuenta</button>
                            </div>
                        </form>

                        <hr class="my-4">

                        <div class="text-center">
                            <p class="text-muted">¿Ya tienes cuenta?</p>
                            <a href="{{ route('login') }}" class="btn btn-outline-dark">Iniciar Sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>