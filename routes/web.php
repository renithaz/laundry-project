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

//Tampilan form perhitungan
Route::get('perhitungan', function () {
    return view('perhitungan.index');
})->name('perhitungan.index');

//Aksi Perhitungannya
Route::post('perhitungan', [App\Http\Controllers\PerhitunganController::class, 'store'])->name('perhitungan.store');

//Tampilan form Luas Permukaan Kubus
Route::get('luaspermukaankubus', [App\Http\Controllers\PerhitunganController::class, 'index'])->name('luaspermukaankubus.index');

//Aksi Perhitungan LP Kubus
Route::post('luaspermukaankubus', [App\Http\Controllers\PerhitunganController::class, 'storeLpKubus'])->name('luaspermukaankubus.store');

//Tampilan form Volume Kubus
Route::get('volumekubus', [App\Http\Controllers\PerhitunganController::class, 'indexVolumeKubus'])->name('volumekubus.index');

//Aksi Perhitungan Volume Kubus
Route::post('volumekubus', [App\Http\Controllers\PerhitunganController::class, 'storeVolumeKubus'])->name('volumekubus.store');

//Tampilan form Luas Permukaan Tabung
Route::get('luaspermukaantabung', [App\Http\Controllers\PerhitunganController::class, 'indexLpTabung'])->name('luaspermukaantabung.index');

//Aksi Perhitungan Luas Permukaan Tabung
Route::post('luaspermukaantabung', [App\Http\Controllers\PerhitunganController::class, 'storeLpTabung'])->name('luaspermukaantabung.store');

//Tampilan form Volume Tabung
Route::get('volumetabung', [App\Http\Controllers\PerhitunganController::class, 'indexVolumeTabung'])->name('volumetabung.index');

//Aksi Perhitungan Volume Tabung
Route::post('volumetabung', [App\Http\Controllers\PerhitunganController::class, 'storeVolumeTabung'])->name('volumetabung.store');

// //Tampilan form Volume Limas Segi Empat
// Route::get('volumelimas', [App\Http\Controllers\VolumeLimasController::class, 'index'])->name('volumelimas.index');

// //Tampilan form Create Volume Limas Segi Empat
// Route::get('volumelimas/create', [App\Http\Controllers\VolumeLimasController::class, 'create'])->name('volumelimas.create');

// //Aksi Perhitungan Volume Limas Segi Empat
// Route::post('volumelimas/store', [App\Http\Controllers\VolumeLimasController::class, 'store'])->name('volumelimas.store');

// //Tampilan form Edit Volume Limas Segi Empat
// Route::get('volumelimas/edit/{id}', [App\Http\Controllers\VolumeLimasController::class, 'edit'])->name('volumelimas.edit');

// //Aksi Update Volume Limas Segi Empat
// Route::put('volumelimas/update/{id}', [App\Http\Controllers\VolumeLimasController::class, 'update'])->name('volumelimas.update');

// //Aksi Delete Volume Limas Segi Empat
// Route::delete('volumelimas/delete/{id}', [App\Http\Controllers\VolumeLimasController::class, 'destroy'])->name('volumelimas.destroy');

Route::resource('volumelimas', App\Http\Controllers\VolumeLimasController::class);

Route::resource('pesertapelatihan', App\Http\Controllers\PesertaPelatihanController::class);


Route::get('belajar-laravel', [App\Http\Controllers\BelajarController::class, 'index'])->name('belajar.index');
Route::get('siswa', [App\Http\Controllers\BelajarController::class, 'getSiswa']);

Route::get('create', [App\Http\Controllers\BelajarController::class, 'create'])->name('siswa.create');
Route::post('store', [App\Http\Controllers\BelajarController::class, 'store'])->name('siswa.store');

Route::get('/', [\App\Http\Controllers\LoginController::class, 'index']);

Route::post('action-login', [\App\Http\Controllers\LoginController::class, 'actionLogin'])->name('action-login');
Route::post('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::resource('user', App\Http\Controllers\UserController::class);
//get, post, put/patch, delete
Route::resource('role', App\Http\Controllers\RoleController::class);
Route::resource('student', App\Http\Controllers\StudentController::class);
Route::resource('attendance', App\Http\Controllers\AttendanceController::class);


Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

// Route::get('/login', function() {
//     return view('nama-view');
// });

Route::get('auth/google', [LoginController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/callback-url', [LoginController::class, 'callbackGoogle']);