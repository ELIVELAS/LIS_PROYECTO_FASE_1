<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Empresa</title>
  @vite(['resources/js/app.js'])
  <style>
    :root{--lila:#a78bfa;--lila-2:#8b5cf6;--borde:#e5e7eb;--bg1:#eef2ff;--bg2:#fdf2f8;--texto:#374151}
    body{margin:0;font-family:system-ui,-apple-system,"Segoe UI",Roboto,Arial;color:var(--texto);
         background:linear-gradient(180deg,var(--bg1) 0%,var(--bg2) 100%)}
    .container{max-width:720px;margin:60px auto;padding:0 16px}
    .card{background:#fff;border:1px solid var(--borde);border-radius:16px;box-shadow:0 10px 30px rgba(17,24,39,.08);padding:24px}
    h3{margin:0 0 12px}
    label{display:block;font-weight:600;margin:12px 0 6px}
    input{width:100%;padding:10px 12px;border:1px solid var(--borde);border-radius:12px}
    input:focus{outline:none;border-color:var(--lila);box-shadow:0 0 0 3px rgba(167,139,250,.25)}
    .btn{border:0;border-radius:12px;padding:10px 16px;font-weight:700;cursor:pointer}
    .btn-primary{background:var(--lila);color:#fff}.btn-primary:hover{background:var(--lila-2)}
    .btn-sec{background:#60a5fa;color:#fff}
    .alert{background:#fee2e2;border:1px solid #fecaca;color:#7f1d1d;padding:10px;border-radius:12px;margin-bottom:12px}
    .ok{background:#dcfce7;border:1px solid #bbf7d0;color:#14532d;padding:10px;border-radius:12px;margin-bottom:12px}
  </style>
</head>
<body>
<div class="container">
  <div class="card">
    <h3>Registro de empresa</h3>

    @if ($errors->any())
      <div class="alert"><ul style="margin:0;padding-left:18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
    @endif
    @if (session('success')) <div class="ok">{{ session('success') }}</div> @endif

    <form method="POST" action="{{ route('register.company') }}">
      @csrf
      <label>Nombre de la empresa</label>
      <input type="text" name="company_name" value="{{ old('company_name') }}" required>

      <label>NIT (0000-000000-000-0 o 14 dígitos)</label>
      <input type="text" name="nit" value="{{ old('nit') }}" required>

      <label>Dirección</label>
      <input type="text" name="address" value="{{ old('address') }}" required>

      <label>Teléfono</label>
      <input type="text" name="phone" value="{{ old('phone') }}" required>

      <label>Correo (para iniciar sesión)</label>
      <input type="email" name="email" value="{{ old('email') }}" required>

      <label>Contraseña</label>
      <input type="password" name="password" required>

      <label>Confirmar contraseña</label>
      <input type="password" name="password_confirmation" required>

      <div style="display:flex;gap:10px;margin-top:16px">
        <button class="btn btn-primary" type="submit">Registrar empresa</button>
        <a class="btn btn-sec" href="{{ route('login') }}">Volver al login</a>
      </div>
    </form>
  </div>
</div>
</body>
</html>
