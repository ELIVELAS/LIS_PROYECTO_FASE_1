@extends('layouts.app')
@section('title','Recuperar contraseña')
@section('content')
<div class="card">
  <h2>Olvidé mi contraseña</h2>
  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="label">Correo</div>
    <input class="input" type="email" name="email" required>
    <div style="margin-top:1rem"><button class="btn">Generar token</button></div>
  </form>

  @if(session('token'))
    <div class="alert ok">
      <div><strong>Token (solo desarrollo):</strong> {{ session('token') }}</div>
      <div>URL directa: {{ url('/password/reset/'.session('token')) }}</div>
    </div>
  @endif
</div>
@endsection
