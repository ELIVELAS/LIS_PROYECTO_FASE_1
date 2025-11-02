@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-3">Nueva oferta</h2>

  <form method="POST" action="{{ route('company.offers.store') }}" class="card shadow-sm p-4">
    @csrf
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
      @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
      @error('description') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Precio</label>
      <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ old('price') }}" required>
      @error('price') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-success">Guardar</button>
      <a href="{{ route('company.offers') }}" class="btn btn-outline-secondary">Cancelar</a>
    </div>
  </form>
</div>
@endsection
