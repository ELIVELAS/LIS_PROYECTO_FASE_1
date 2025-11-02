@extends('layouts.app')
@section('title','Restablecer contraseña')
@section('content')
<div class="card">
  <h2>Restablecer contraseña</h2>
  <form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="label">Correo</div>
    <input class="input" type="email" name="email" required>
    <div class="label">Nueva contraseña</div>
    <input class="input" type="password" name="password" required>
    <div class="label">Confirmar contraseña</div>
    <input class="input" type="password" name="password_confirmation" required>
    <div style="margin-top:1rem"><button class="btn primary">Guardar</button></div>
  </form>
</div>
@endsection
