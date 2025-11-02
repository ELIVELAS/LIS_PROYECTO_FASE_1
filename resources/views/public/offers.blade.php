@extends('layouts.app')
@section('content')
<div class="container">
  <h3>Promociones disponibles</h3>
  <div class="row">
    @foreach($offers as $o)
      <div class="col-md-4 mb-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>{{ $o->title }}</h5>
            <p class="m-0"><del>${{ number_format($o->price_regular,2) }}</del></p>
            <p class="fs-4">${{ number_format($o->price_offer,2) }}</p>
            <p class="text-muted">Canje hasta {{ $o->redeem_deadline->format('d/m/Y') }}</p>
            <a class="btn btn-success" href="{{ route('purchase.form',$o->id) }}">Comprar</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
