<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;

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
//Route::resource('pasien', PasienController::class);

Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
Route::get('/pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');
Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
Route::patch('/pasien/{id}', [PasienController::class, 'update']);
Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');