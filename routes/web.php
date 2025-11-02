<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

// -------------------- Auth --------------------
Route::get('/login',  [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// -------------------- Rutas públicas --------------------
Route::get('/ofertas', [PublicController::class, 'index'])->name('public.offers');

// Registro y recuperación (solo invitados)
Route::middleware('guest')->group(function () {
    // Cliente
    Route::get('/registro/cliente',  [RegisterController::class, 'clienteForm'])->name('register.client');
    Route::post('/registro/cliente', [RegisterController::class, 'clienteStore'])->name('register.client.store');

    // Empresa
    Route::get('/registro/empresa',  [RegisterController::class, 'empresaForm'])->name('register.company');
    Route::post('/registro/empresa', [RegisterController::class, 'empresaStore'])->name('register.company.store');

    // Password reset (flujo simple)
    Route::get('/password/forgot',        [PasswordResetController::class, 'requestForm'])->name('password.request');
    Route::post('/password/forgot',       [PasswordResetController::class, 'sendToken'])->name('password.email');
    Route::get('/password/reset/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
    Route::post('/password/reset',        [PasswordResetController::class, 'reset'])->name('password.update');
});

// -------------------- Rutas protegidas --------------------
Route::middleware('auth')->group(function () {
    // Dashboard (ÚNICA definición)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Usuarios (gestionados por admin)
    Route::get('/usuarios/create',     [UserController::class, 'create'])->name('users.create');
    Route::post('/usuarios/save',      [UserController::class, 'save'])->name('usuarios.save');
    Route::get('/usuarios/{user}/edit',[UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{user}',     [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{user}',  [UserController::class, 'destroy'])->name('usuarios.destroy');

    // Admin: empresas y reportes
    Route::get('/admin/empresas',                               [AdminController::class, 'companies'])->name('admin.companies');
    Route::post('/admin/empresas/{company}/aprobar',            [AdminController::class, 'approve'])->name('admin.companies.approve');
    Route::get('/admin/reportes',                                [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/admin/usuarios/admin/create',                  [AdminController::class, 'createAdmin'])->name('admin.create');
    Route::post('/admin/usuarios/admin',                        [AdminController::class, 'storeAdmin'])->name('admin.store');

    // Empresa: perfil y ofertas
    Route::get('/empresa/perfil',          [CompanyController::class, 'profile'])->name('company.profile');
    Route::post('/empresa/perfil',         [CompanyController::class, 'saveProfile'])->name('company.profile.save');
    Route::get('/empresa/ofertas',         [CompanyController::class, 'offers'])->name('company.offers');
    Route::get('/empresa/ofertas/create',  [CompanyController::class, 'createOffer'])->name('company.offers.create');
    Route::post('/empresa/ofertas',        [CompanyController::class, 'storeOffer'])->name('company.offers.store');

    // Compras (cliente)
    Route::get('/comprar/{offer}',    [PurchaseController::class, 'buyForm'])->name('purchase.form');
    Route::post('/comprar/{offer}',   [PurchaseController::class, 'buy'])->name('purchase.buy');
    Route::get('/factura/{purchase}', [PurchaseController::class, 'invoice'])->name('purchase.invoice');
});
