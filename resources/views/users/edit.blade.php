<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js']) <!-- incluyendo procesamiento con vite (recuerden que deben ejecutar npm run dev para que esto funcione correctamente) -->
</head>

<body class="bg-light">

    <div class="container mt-5">


<div class="container mt-5" style="max-width: 700px;">
    <h4 class="mb-4">Editar usuario</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hay errores:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
            <input type="password" name="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $user->firstname) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $user->lastname) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de usuario</label>
            
            <select name="user_type" class="form-select" required>
               
                <option value="">Seleccione...</option>
                @foreach ($tipos as $t)
                    <option value="{{ $t->id }}" {{ (old('user_type', $user->user_type_id) == $t->id) ? 'selected' : '' }}>
                        {{ $t->description }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Guardar cambios</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

</div>
</body>
</html>