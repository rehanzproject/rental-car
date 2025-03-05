<?php

use App\Models\Armada;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BayarController;
use App\Http\Controllers\SupirController;
use App\Http\Controllers\ArmadaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TypeMobilController;

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




// -----Welcome----- //

// Halaman Utama
Route::get('/', function () {
    $armadas = Armada::latest()->get();
    return view('welcome', compact('armadas'));
})->name('welcome');

// Mobil
Route::prefix('mobil')->controller(ArmadaController::class)->group(function () {
    Route::get('/', 'mobil')->name('mobil');
    Route::get('/filter', 'filter')->name('filter');
});

// Transaksi
Route::prefix('transaksi')->controller(TransaksiController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', 'index')->name('transaksi');
    Route::get('/bayar/{armadaId}', 'create')->name('transaksi.create');
    Route::post('/bayar/{armadaId}', 'store')->name('transaksi.store');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Bayar
    Route::controller(BayarController::class)->group(function () {
        Route::post('/transaksi/{transaksiId}', 'store')->name('bayar.store');
        Route::put('/transaksi/{transaksi}', 'cancel')->name('bayar.cancel');
        Route::put('/dashboard/transaksi/setuju/{transaksi}', 'setuju')->name('bayar.setuju');
        Route::put('/dashboard/transaksi/selesai/{transaksi}', 'selesai')->name('bayar.selesai');
    });

    // Profile
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'profile')->name('profile');
        Route::put('/{id}', 'update')->name('profile.update');
    });

    // Contact
    Route::get('/contact', function () { return view('contact'); })->name('contact');
});

// -----Welcome----- //


// -----Dashboard----- //

Auth::routes();
Route::prefix('dashboard')->middleware(['auth', 'Admin'])->group(function () {

    // Profile Dashboard
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard.profile');
    });

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Transaksi
    Route::prefix('transaksi')->controller(TransaksiController::class)->group(function () {
        // Index //
        Route::get('/semuaTransaksi', 'semua')->name('transaksi.semua');
        Route::get('/belumBayar', 'belumBayar')->name('transaksi.belumBayar');
        Route::get('/belumSetuju', 'belumSetuju')->name('transaksi.belumSetuju');
        Route::get('/sedangBeroperasi', 'sedangBeroperasi')->name('transaksi.sedangBeroperasi');
        Route::get('/selesai', 'selesai')->name('transaksi.selesai');
        Route::get('/batal', 'batal')->name('transaksi.batal');
        // List //
        Route::get('/semuaTransaksi/list',  'semualist')->name('transaksi.semualist');
        Route::get('/belumBayar/list',  'belumBayarlist')->name('transaksi.belumBayarlist');
        Route::get('/belumSetuju/list',  'belumSetujulist')->name('transaksi.belumSetujulist');
        Route::get('/sedangBeroperasi/list',  'sedangBeroperasilist')->name('transaksi.sedangBeroperasilist');
        Route::get('/selesai/list',  'selesailist')->name('transaksi.selesailist');
        Route::get('/batal/list',  'batallist')->name('transaksi.batallist');
    });

    // Master Type Mobil
    Route::prefix('typemobil')->controller(TypeMobilController::class)->group(function () {
        Route::get('/', 'index')->name('typemobil.index');
        Route::get('/typemobil',  'list')->name('typemobil.list');
        Route::post('/', 'store')->name('typemobil.create');
        Route::put('/{typemobil}', 'update')->name('typemobil.edit');
        Route::delete('/{typemobil}', 'destroy')->name('typemobil.destroy');
    });

    // Master Supir
    Route::prefix('supir')->controller(SupirController::class)->group(function () {
        Route::get('/', 'index')->name('supir.index');
        Route::get('/supir',  'list')->name('supir.list');
        Route::post('/', 'store')->name('supir.create');
        Route::put('/{supir}', 'update')->name('supir.edit');
        Route::delete('/{supir}', 'destroy')->name('supir.destroy');
    });

    // Master Armada
    Route::prefix('armada')->controller(ArmadaController::class)->group(function () {
        Route::get('/', 'index')->name('armada.index');
        Route::get('/armada',  'list')->name('armada.list');
        Route::post('/', 'store')->name('armada.create');
        Route::put('/{armada}', 'update')->name('armada.edit');
        Route::delete('/{armada}', 'destroy')->name('armada.destroy');
    });

    // Customer
    Route::prefix('customer')->controller(CustomerController::class)->group(function () {
        Route::get('/', 'index')->name('customer.index');
        Route::get('/customer',  'list')->name('customer.list');
        Route::put('/{user}', 'update')->name('customer.edit');
        Route::delete('/{user}', 'destroy')->name('customer.destroy');
    });
});

// -----Dashboard----- //