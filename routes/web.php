<?php

use App\Http\Controllers\AlpacaController;
use App\Http\Controllers\AlphaIntelligenceController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\FundamentalDataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TradesController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('crypto', [CryptoController::class, 'index'])->name('crypto.index');
Route::get('crypto/intraday', [CryptoController::class, 'intraday'])->name('crypto.intraday');

Route::get('data', [FundamentalDataController::class, 'earnings'])->name('data.earnings');

Route::post('testNotification', [FundamentalDataController::class, 'testNotification'])->name('testNotification');

Route::get('alpaca', [AlpacaController::class, 'index'])->name('alpaca.index');

Route::get('alpha-intelligence/topGainersAndLosers', [AlphaIntelligenceController::class, 'topGainersAndLosers'])->name('alpha-intelligence.topGainersAndLosers');

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
