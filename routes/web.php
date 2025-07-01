<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CustomFieldController;

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Redirect root to admin
Route::get('/', function () {
    return redirect('/admin');
});

// Admin routes 
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Customer routes
    Route::get('/admin/customers', [AdminController::class, 'customers'])->name('admin.customers');
    Route::get('/admin/customers/create', [AdminController::class, 'createCustomer'])->name('admin.customers.create');
    Route::get('/admin/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('admin.customers.edit');
    
    // Invoice routes
    Route::get('/admin/invoices', [AdminController::class, 'invoices'])->name('admin.invoices');
    Route::get('/admin/invoices/create', [AdminController::class, 'createInvoice'])->name('admin.invoices.create');
    Route::get('/admin/invoices/{id}/edit', [AdminController::class, 'editInvoice'])->name('admin.invoices.edit');
    
    // Custom Fields routes
    Route::get('/admin/custom-fields', [CustomFieldController::class, 'index'])->name('admin.custom-fields');
    Route::get('/admin/custom-fields/create', [CustomFieldController::class, 'create'])->name('admin.custom-fields.create');
    Route::post('/admin/custom-fields', [CustomFieldController::class, 'store'])->name('admin.custom-fields.store');
    
    // API routes
    Route::get('/api/list', [ApiController::class, 'list'])->name('api.list');
    Route::post('/api/create', [ApiController::class, 'create'])->name('api.create');
    Route::put('/api/update/{id}', [ApiController::class, 'update'])->name('api.update');
});
