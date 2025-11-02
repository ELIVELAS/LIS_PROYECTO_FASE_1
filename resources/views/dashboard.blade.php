@extends('layouts.app')
@section('title','Dashboard')

@section('content')
@php $role = (int) (Auth::user()->user_type_id ?? 0); @endphp

<h2 class="mb-2">Bienvenido, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h2>
<p class="mb-3">Tipo de usuario:
  <span class="badge badge-soft">{{ Auth::user()->userType->description ?? '-' }}</span>
</p>

<div class="alert alert-info py-2 mb-4">Rol numérico detectado: <strong>{{ $role }}</strong></div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
@if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

@if($role === 1)
  <a class="btn btn-primary me-2" href="{{ route('admin.companies') }}">Aprobar empresas</a>
  <a class="btn btn-outline-secondary" href="{{ route('users.create') }}">Agregar usuario</a>
@elseif($role === 2)
  <a class="btn btn-primary me-2" href="{{ route('company.offers') }}">Mis ofertas</a>
  <a class="btn btn-outline-secondary" href="{{ route('company.profile') }}">Mi perfil</a>
@elseif($role === 3)
  <a class="btn btn-primary" href="{{ route('public.offers') }}">Ver ofertas disponibles</a>
@else
  <div class="alert alert-warning mb-0">Tu rol no está configurado correctamente.</div>
@endif
@endsection
