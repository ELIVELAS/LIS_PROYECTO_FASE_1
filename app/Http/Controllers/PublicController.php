<?php

namespace App\Http\Controllers;

use App\Models\Offer;

class PublicController extends Controller
{
  public function index()
{
    $offers = \App\Models\Offer::publicAvailable()->latest()->get();
    return view('public.offers.index', compact('offers'));
}

}
