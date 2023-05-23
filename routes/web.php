<?php

use App\Models\KerjaSama;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\KerjaSamaController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\SupplierBahanBakuController;
use App\Http\Controllers\SupplierPemasukanController;


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
    return view('welcome');
});

Route::get('/landingpage', [LandingPageController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');

    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Bahan Baku
    Route::resource("pemilik-bahan-baku", BahanBakuController::class);
    Route::get("kerja-sama", [KerjaSamaController::class, "index"])->name("kerja-sama.index");

    // Supplier
    Route::resource("supplier-bahan-baku", SupplierBahanBakuController::class);
    Route::resource("supplier-pemasukan", SupplierPemasukanController::class);

    // Laporan Keuangan
    Route::get("laporan-keuangan", [LaporanKeuanganController::class, "index"])->name("laporan-keuangan");


    // Kerja Sama
    /* Pemilik Usaha */
    Route::post("kerja-sama", [KerjaSamaController::class, "store"])->name("kerja-sama.store");
    Route::post("kerja-sama/permintaan/{kerjaSama_id}", [KerjaSamaController::class, "storePermintaan"])->name("kerja-sama.storePermintaan");
    Route::get("kerja-sama/riwayat/{kerjaSama}", [KerjaSamaController::class, "index_riwayat"])->name("kerja-sama.riwayat.index");
    Route::put("kerja-sama/persetujuan/{kerjaSama}", [KerjaSamaController::class, "updateKerjaSama"])->name("kerja-sama.persetujuan.updateKerjaSama");
});
