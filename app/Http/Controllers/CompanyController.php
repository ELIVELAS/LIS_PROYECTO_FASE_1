<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function offers()
    {
        $company = Company::where('user_id', Auth::id())->first();

        if (!$company) {
            return redirect()
                ->route('company.profile')
                ->with('warning', 'Completa tu perfil de empresa antes de gestionar ofertas.');
        }

        $offers = Offer::where('company_id', $company->id)->latest()->get();

        // vista: resources/views/company/offers/index.blade.php
        return view('company.offers.index', compact('company', 'offers'));
    }

    public function createOffer()
    {
        $company = Company::where('user_id', Auth::id())->first();

        if (!$company) {
            return redirect()
                ->route('company.profile')
                ->with('warning', 'Completa tu perfil de empresa antes de publicar ofertas.');
        }

        // vista: resources/views/company/offers/create.blade.php
        return view('company.offers.create', compact('company'));
    }

    public function storeOffer(Request $request)
    {
        $company = Company::where('user_id', Auth::id())->first();

        if (!$company) {
            return redirect()->route('company.profile')
                ->with('warning', 'Completa tu perfil de empresa antes de publicar ofertas.');
        }

        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
        ]);

        $data['company_id'] = $company->id;

        Offer::create($data);

        return redirect()->route('company.offers')
            ->with('success', 'Oferta creada correctamente.');
    }

    public function profile()
    {
        // Carga o crea en memoria el perfil de la empresa del usuario
        $company = Company::firstOrNew(['user_id' => Auth::id()]);
        // vista: resources/views/company/profile.blade.php
        return view('company.profile', compact('company'));
    }

    public function saveProfile(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'nit'     => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
        ]);

        Company::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

        return redirect()->route('company.offers')
            ->with('success', 'Perfil de empresa guardado.');
    }
}
