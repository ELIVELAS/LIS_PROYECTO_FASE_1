@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Nueva oferta</h3>
  <form method="POST" action="{{ route('company.offers.store') }}">
    @csrf
    <div class="mb-3"><label>Título</label>
      <input name="title" class="form-control" required>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3"><label>Precio regular</label>
        <input type="number" step="0.01" name="price_regular" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3"><label>Precio oferta</label>
        <input type="number" step="0.01" name="price_offer" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3"><label>Cantidad de cupones (opcional)</label>
        <input type="number" min="1" name="stock" class="form-control">
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 mb-3"><label>Inicio</label>
        <input type="date" name="start_date" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3"><label>Fin</label>
        <input type="date" name="end_date" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3"><label>Fecha límite canje</label>
        <input type="date" name="redeem_deadline" class="form-control" required>
      </div>
    </div>
    <div class="mb-3"><label>Descripción</label>
      <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <div class="mb-3"><label>Estado</label>
      <select name="status" class="form-select" required>
        <option value="1">Disponible</option>
        <option value="0">No disponible</option>
      </select>
    </div>
    <button class="btn btn-primary">Publicar</button>
  </form>
</div>
@endsection
