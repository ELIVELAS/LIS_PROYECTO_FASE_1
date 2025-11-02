@extends('layouts.app')
@section('title','Empresas')

@section('content')
<h3 class="mb-3">Empresas registradas</h3>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>#</th><th>Nombre</th><th>NIT</th><th>Teléfono</th><th>Aprobada</th><th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($companies as $c)
      <tr>
        <td>{{ $c->id }}</td>
        <td>{{ $c->name }}</td>
        <td>{{ $c->nit }}</td>
        <td>{{ $c->phone }}</td>
        <td>{{ $c->approved ? 'Sí' : 'No' }}</td>
        <td>
          @if(!$c->approved)
            <form action="{{ route('admin.companies.approve',$c->id) }}" method="POST">
              @csrf
              <button class="btn btn-sm btn-success">Aprobar</button>
            </form>
          @else
            <span class="text-muted">—</span>
          @endif
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
