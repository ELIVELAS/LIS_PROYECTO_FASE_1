<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Iniciar sesión</title>
    @vite(['resources/js/app.js'])

    <style>
        /* === Estilo pastel suave (independiente) === */
        :root{
            --lila:#a78bfa; --lila-2:#8b5cf6;
            --rosa:#fb7185; --rosa-2:#f43f5e;
            --texto:#374151; --tit:#111827; --borde:#e5e7eb;
            --bg1:#eef2ff; --bg2:#fdf2f8;
        }
        html,body{height:100%}
        body{
            margin:0; font-family:system-ui,-apple-system,"Segoe UI",Roboto,Arial;
            color:var(--texto);
            background:linear-gradient(180deg,var(--bg1) 0%, var(--bg2) 100%);
        }
        .container{max-width:520px;margin:60px auto;padding:0 16px}
        .card{background:#fff; border:1px solid var(--borde); border-radius:16px;
              box-shadow:0 10px 30px rgba(17,24,39,.08); padding:24px; backdrop-filter:blur(6px)}
        h2{color:var(--tit); margin:0 0 12px}

        label{display:block; font-weight:600; margin:12px 0 6px}
        input[type="email"], input[type="password"]{
            width:100%; padding:10px 12px; border:1px solid var(--borde);
            border-radius:12px; outline:none; font-size:15px; background:#fff;
        }
        input[type="email"]:focus, input[type="password"]:focus{
            border-color:var(--lila); box-shadow:0 0 0 3px rgba(167,139,250,.25);
        }

        .row-between{display:flex; align-items:center; justify-content:space-between; gap:12px; margin-top:10px}
        .btn{display:inline-block;border:0;border-radius:12px;padding:10px 16px;font-weight:700;cursor:pointer}
        .btn:active{transform:scale(.98)}
        .btn-primario{background:var(--lila);color:#fff}.btn-primario:hover{background:var(--lila-2)}
        .link{color:#7c3aed;text-decoration:none}.link:hover{text-decoration:underline}
        .alert{
            background:#fee2e2;border:1px solid #fecaca;color:#7f1d1d;
            padding:10px 12px;border-radius:12px;margin-bottom:12px
        }
        .muted{color:#6b7280;font-size:13px;margin-top:14px;text-align:center}
    </style>
</head>
<body>
<div class="row-between" style="justify-content:flex-end; gap:16px; margin-top:14px">
    <a class="link" href="{{ route('register.client') }}">Registro Cliente</a>
    <a class="link" href="{{ route('register.company') }}">Registro Empresa</a>
</div>

<div class="container">
    <div class="card">
        <h2>Iniciar sesión</h2>

        {{-- Errores de validación / credenciales --}}
        @if ($errors->any())
            <div class="alert">
                @foreach ($errors->all() as $e)
                    <div>{{ $e }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <label for="email">Correo</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" autofocus required>

            <label for="password">Contraseña</label>
            <input id="password" type="password" name="password" required>

            <div class="row-between">
                <label style="display:flex;align-items:center;gap:8px;font-weight:500">
                    <input type="checkbox" name="remember" value="1"> Recuérdame
                </label>

                <a class="link" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
            </div>

            <div style="margin-top:16px">
                <button class="btn btn-primario" type="submit">Entrar</button>
            </div>
        </form>

        <div class="muted">Hecho por Elizabeth López Fase 1 • 2025</div>
    </div>
</div>

</body>
</html>
