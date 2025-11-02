@extends('layouts.app')
@section('content')
<div class="container" style="max-width:720px">
  <div class="card shadow-sm">
    <div class="card-body">
      <h4>Factura</h4>
      <p><b>Código de validación:</b> {{ $purchase->invoice_code }}</p>
      <hr>
      <p><b>Oferta:</b> {{ $purchase->offer->title }}</p>
      <p><b>Cantidad:</b> {{ $purchase->qty }}</p>
      <p><b>Precio unitario:</b> ${{ number_format($purchase->unit_price,2) }}</p>
      <p><b>Total:</b> ${{ number_format($purchase->total,2) }}</p>
      <hr>
      <p class="text-muted">Tarjeta **** **** **** {{ $purchase->card_last4 }} — vence {{ $purchase->card_exp->format('m/Y') }}</p>
      <p class="text-muted">Fecha: {{ $purchase->created_at->format('d/m/Y H:i') }}</p>
    </div>
  </div>
</div>
@endsection
