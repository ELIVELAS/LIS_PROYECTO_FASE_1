<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Offer;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function buyForm(Offer $offer)
    {
        return view('purchase.form', compact('offer'));
    }

    public function buy(Request $request, Offer $offer)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $purchase = Purchase::create([
            'user_id'   => Auth::id(),
            'offer_id'  => $offer->id,
            'quantity'  => $request->quantity,
            'unit_price'=> $offer->price,
            'total'     => $offer->price * $request->quantity,
        ]);

        return redirect()->route('purchase.invoice', $purchase->id);
    }

    public function invoice(Purchase $purchase)
    {
        return view('purchase.invoice', compact('purchase'));
    }
}
