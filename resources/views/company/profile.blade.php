@extends('layouts.app')
@section('title','Mi perfil')

@section('content')
<h3 class="mb-3">Perfil de la empresa</h3>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<form method="POST" action="{{ route('company.profile.save') }}" class="row g-3">
  @csrf
  <div class="col-md-6">
    <label class="form-label">Nombre comercial *</label>
    <input type="text" name="name" class="form-control" value="{{ old('name',$company->name) }}" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">NIT *</label>
    <input type="text" name="nit" class="form-control" value="{{ old('nit',$company->nit) }}" required>
  </div>
  <div class="col-md-4">
    <label class="form-label">Teléfono</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone',$company->phone) }}">
  </div>
  <div class="col-md-5">
    <label class="form-label">Dirección</label>
    <input type="text" name="address" class="form-control" value="{{ old('address',$company->address) }}">
  </div>
  <div class="col-md-3">
    <label class="form-label">Ciudad</label>
    <input type="text" name="city" class="form-control" value="{{ old('city',$company->city) }}">
  </div>
  <div class="col-12">
    <button class="btn btn-success">Guardar</button>
  </div>
</form>
@endsection
