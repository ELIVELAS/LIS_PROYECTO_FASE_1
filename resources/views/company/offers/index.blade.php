@extends('layouts.app')
@section('title','Mis Ofertas')
@section('content')
<div class="card">
  <div style="display:flex;justify-content:space-between;align-items:center">
    <h2>Mis Ofertas</h2>
    <a class="btn primary" href="{{ route('company.offers.create') }}">Nueva oferta</a>
  </div>
  <table class="table">
    <thead><tr><th>Título</th><th>Precio</th><th>Stock</th><th>Activa</th></tr></thead>
    <tbody>
      @foreach($offers as $o)
        <tr>
          <td>{{ $o->title }}</td>
          <td>$ {{ number_format($o->price,2) }}</td>
          <td>{{ $o->stock }}</td>
          <td>{{ $o->active ? 'Sí' : 'No' }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
