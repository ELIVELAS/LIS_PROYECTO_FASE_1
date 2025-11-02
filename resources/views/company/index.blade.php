@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-3">Mis ofertas</h2>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @if(session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
  @endif

  <a href="{{ route('company.offers.create') }}" class="btn btn-primary mb-3">Nueva oferta</a>

  @if($offers->isEmpty())
    <div class="alert alert-info m-0">Aún no has publicado ofertas.</div>
  @else
    <div class="card shadow-sm">
      <div class="card-body p-0">
        <table class="table table-hover m-0">
          <thead class="table-light">
            <tr>
              <th>Título</th>
              <th>Precio</th>
              <th>Creada</th>
            </tr>
          </thead>
          <tbody>
          @foreach($offers as $o)
            <tr>
              <td>{{ $o->title }}</td>
              <td>${{ number_format($o->price,2) }}</td>
              <td>{{ $o->created_at->format('Y-m-d H:i') }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif
</div>
@endsection
