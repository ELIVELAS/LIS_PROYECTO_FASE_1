<?php

namespace App\Http\Controllers;

use App\Models\Company;

class AdminController extends Controller
{
    public function companies()
    {
        $companies = Company::orderBy('approved')->orderBy('name')->get();
        return view('admin.empresas', compact('companies'));
    }

    public function approve(Company $company)
    {
        $company->update(['approved' => true]);
        return back()->with('success', 'Empresa aprobada.');
    }
}
