@extends('layouts.app')
@section('content')
<div class="container" style="max-width:600px">
  <h3>Comprar: {{ $offer->title }}</h3>
  <p>Precio: <b>${{ number_format($offer->price_offer,2) }}</b></p>
  <form method="POST" action="{{ route('purchase.buy',$offer->id) }}">
    @csrf
    <div class="mb-3"><label>Cantidad</label>
      <input type="number" name="qty" class="form-control" min="1" max="5" value="1" required>
      <small class="text-muted">Máximo 5 por oferta</small>
    </div>
    <div class="mb-3"><label>Número de tarjeta</label>
      <input name="card_number" class="form-control" maxlength="19" placeholder="4111 1111 1111 1111" required>
    </div>
    <div class="row">
      <div class="col-md-6 mb-3"><label>Vence (MM/AAAA)</label>
        <input name="card_exp" class="form-control" placeholder="08/2030" required>
      </div>
      <div class="col-md-6 mb-3"><label>CVV</label>
        <input name="cvv" class="form-control" maxlength="4" required>
      </div>
    </div>
    <button class="btn btn-success">Pagar</button>
  </form>
</div>
@endsection
