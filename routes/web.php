<?php
//get = melihat data atau menampilkannya
//post = mengirim data
//put/patch =  merubah atau mengedit data
//delete = menghapus data

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('navbar', function () {
    return view('inc.navbar');
});


Route::get('/', [\App\Http\Controllers\LoginController::class, 'index']);

//Login-logout
Route::post('action-login', [\App\Http\Controllers\LoginController::class, 'actionLogin'])->name('action-login');
Route::post('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::middleware(['level:administrator'])->group(function () {
    //master data
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', App\Http\Controllers\UserController::class);
    //get, post, put/patch, delete
    Route::resource('level', App\Http\Controllers\LevelController::class);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::resource('service', App\Http\Controllers\ServiceController::class);

    //transaksi
    Route::get('transaction/print/{id}', [App\Http\Controllers\TransOrderController::class, 'print'])->name('transaction.print');
    Route::resource('transaction', App\Http\Controllers\TransOrderController::class);
    Route::resource('pickup', App\Http\Controllers\PickupLaundryController::class);

    //laporan
    Route::resource('report', App\Http\Controllers\ReportController::class);

    
});



// Route::get('/login', function() {
//     return view('nama-view');
// });