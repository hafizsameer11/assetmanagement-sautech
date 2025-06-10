<?php

use App\Http\Controllers\AssetAuditController;
use App\Http\Controllers\AssetRegisterController;
use App\Http\Controllers\AuditFieldController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
});
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');
Route::post('/users/{id}/delete', [UserController::class, 'destroy'])->name('users.destroy');



Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients/store', [ClientController::class, 'store'])->name('clients.store');
Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::post('/clients/{id}/update', [ClientController::class, 'update'])->name('clients.update');
Route::post('/clients/{id}/delete', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::get('/clients/{id}/view', [ClientController::class, 'show'])->name('clients.show');
Route::prefix('clients/{clientId}/registers')->controller(AssetRegisterController::class)->group(function () {
    Route::get('/', 'index')->name('asset-register.index');
    Route::post('/upload', 'upload')->name('asset-register.upload');
    Route::get('/{register}', 'show')->name('asset-register.show');
    Route::post('/{register}/delete', 'destroy')->name('asset-register.destroy');
});

Route::get('/asset-registers', [AssetRegisterController::class, 'selectClient'])->name('asset-register.select');

Route::prefix('clients/{clientId}/audit-fields')->controller(AuditFieldController::class)->group(function () {
    Route::get('/', 'index')->name('audit-fields.index');
    Route::post('/store', 'store')->name('audit-fields.store');
    Route::post('/{field}/update', 'update')->name('audit-fields.update');
    Route::post('/{field}/delete', 'destroy')->name('audit-fields.destroy');
});
Route::get('/audit-fields', [AuditFieldController::class, 'selectClient'])->name('audit-fields.select');


//asset audit routes
Route::prefix('clients/{clientId}/audits')->controller(AssetAuditController::class)->group(function () {
    Route::get('/', 'index')->name('asset-audit.index');
    Route::post('/upload', 'upload')->name('asset-audit.upload');
    Route::post('/{audit}/delete', 'destroy')->name('asset-audit.destroy');
});

Route::get('/asset-audits', function () {
    return view('asset_audit.select-client', ['clients' => App\Models\Client::orderBy('company_name')->get()]);
})->name('asset-audit.select');
