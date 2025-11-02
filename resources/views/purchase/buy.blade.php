@extends('layouts.app')
@section('title','Comprar')
@section('content')
<div class="card">
  <h2>Comprar: {{ $offer->title }}</h2>
  <p>Precio unitario: $ {{ number_format($offer->price,2) }} | Stock disponible: {{ $offer->stock }}</p>
  <form method="POST" action="{{ route('purchase.buy',$offer) }}">
    @csrf
    <div class="label">Cantidad (máximo 5 por oferta)</div>
    <input class="input" name="quantity" type="number" min="1" max="5" value="1" required>
    <div style="margin-top:1rem"><button class="btn primary">Pagar con tarjeta (simulado)</button></div>
  </form>
</div>
@endsection
