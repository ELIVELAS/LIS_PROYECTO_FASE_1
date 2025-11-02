<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>@yield('title','Proyecto Fase 1')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Bootstrap 5 mínimo + Pastel Theme --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root{
      --pastel-bg: #f7f5ff;
      --pastel-card: #ffffffcc;
      --pastel-1: #c5c9ff;
      --pastel-2: #f9c6d4;
      --pastel-3: #c1f0e4;
      --pastel-4: #ffecc7;
      --text-1: #2b2b3c;
    }
    body{
      background: radial-gradient(1200px 600px at -20% -20%, var(--pastel-3), transparent 60%),
                  radial-gradient(1000px 500px at 120% -10%, var(--pastel-2), transparent 60%),
                  radial-gradient(900px 500px at 50% 120%, var(--pastel-1), transparent 60%),
                  var(--pastel-bg);
      color: var(--text-1);
    }
    .navbar{
      background: #ffffffa8;
      backdrop-filter: blur(6px);
      border-bottom: 1px solid #ececff;
    }
    .card{
      border: 0;
      border-radius: 18px;
      background: var(--pastel-card);
      box-shadow: 0 8px 26px rgba(113, 97, 255, .12);
    }
    .table { background: #fff; border-radius: 12px; overflow: hidden; }
    .table th { background: #f2f1ff !important; }
    .btn-primary{ background:#7c83ff; border-color:#7c83ff; }
    .btn-primary:hover{ background:#6c72ff; border-color:#6c72ff; }
    .btn-success{ background:#66d4b3; border-color:#66d4b3; }
    .btn-success:hover{ background:#58c6a6; border-color:#58c6a6; }
    .btn-outline-secondary{ color:#6f6c8f; border-color:#bdb8ff; }
    .btn-outline-secondary:hover{ background:#efefff; }
    .badge-soft{ background:#efefff; color:#5f5aa8; border:1px solid #dcd9ff;}
    .page-wrap{ max-width: 1100px; margin: 30px auto; padding:0 16px; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">Proyecto Fase 1</a>
      <div class="ms-auto d-flex gap-2">
        @auth
          <form action="{{ route('logout') }}" method="POST">@csrf
            <button class="btn btn-sm btn-danger">Cerrar sesión</button>
          </form>
        @endauth
      </div>
    </div>
  </nav>

  <main class="page-wrap">
    <div class="card p-4 p-md-5 mb-4">
      @yield('content')
    </div>
    @yield('below')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
