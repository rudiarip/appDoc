<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PasienDetailController;

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

Route::get('/', fn () =>  to_route('detail.index'));
//Route::resource('pasien', PasienController::class);

// Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
Route::get('/pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');
Route::get('/pasien/{id}/detail', [PasienController::class, 'detail'])->name('pasien.detail');
Route::post('/pasien/{id}/edit', [PasienController::class, 'update'])->name('pasien.update');
Route::patch('/pasien/{id}', [PasienController::class, 'update']);
Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
Route::delete('/pasien/delete/{id}', [PasienController::class, 'destroy'])->name('pasien.delete');


Route::get('dashboard', [DashboardController::class, 'index'])->name('index');

Route::group([
    'prefix' => 'patients',
    'as' => 'patient.',
], function () {
});
// Route::view('patients', 'pasien.index')->name('patient.index');
// Route::view('add', 'pasien.add')->name('patient.add');

Route::controller(PasienDetailController::class)
    ->as('detail.')
    ->group(function () {
        Route::get('pasien', 'index')->name('index');
        Route::get('detail/{id}', 'show')->name('show');
        Route::get('detail/create', 'create')->name('create');
        // Route::post('detail', 'store')->name('store');
        Route::post('detail/{pasien}', 'store')->name('store');
        Route::get('detail/{id}/edit', 'edit')->name('edit');
        Route::put('detail/{id}', 'update')->name('update');
        Route::patch('detail/{id}', 'update')->name('update');
        Route::delete('detail/{id}', 'destroy')->name('destroy');
        Route::get('view-detail/{id}', 'viewDetail')->name('view-detail');
    });
