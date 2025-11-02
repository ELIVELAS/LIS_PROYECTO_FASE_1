<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar usuario</title>
    {{-- Si usas Vite en Laravel 12, carga CSS/JS así: --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-light">

    <div class="container mt-5" style="max-width: 600px;">
        <h4 class="mb-4">Agregar nuevo usuario</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Atención!</strong> Hay errores en el formulario.<br><br>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('usuarios.save') }}">
            @csrf

            {{-- Email (antes era username) --}}
            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            {{-- Confirmación opcional (si tu controlador valida "confirmed") --}}
            {{-- <div class="mb-3">
                <label class="form-label">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div> --}}

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="firstname" class="form-control" value="{{ old('firstname') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido</label>
                <input type="text" name="lastname" class="form-control" value="{{ old('lastname') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de usuario</label>
                <select name="user_type_id" class="form-select" required>
                    <option value="">Seleccione...</option>
                    @foreach ($userTypes as $t)
                        <option value="{{ $t->id }}" @selected(old('user_type_id')==$t->id)>
                            {{ $t->description }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
