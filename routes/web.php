<?php

use Illuminate\Support\Facades\Route;


//get = melihat data atau menampilkannya
//post = mengirim data
//put/patch = merubah atau mengedit data
//delete = menghapus data
Route::get('navbar', function () {
    return view('inc/navbar');
});
//Tampilan form perhitungan
Route::get('perhitungan', function () {
    return view('perhitungan.index');
})->name('perhitungan.index');

//Aksi Perhitungannya
Route::post('perhitungan', [App\Http\Controllers\PerhitunganController::class, 'store'])->name('perhitungan.store');

//Tampilan form Luas Permukaan Kubus
Route::get('luaspermukaankubus', [App\Http\Controllers\PerhitunganController::class, 'index'])->name('luaspermukaankubus.index');

//Aksi perhitungan luas kubus
Route::post('luaspermukaankubus', [App\Http\Controllers\PerhitunganController::class, 'storeLpKubus'])->name('luaspermukaankubus.store');

//Tampilan form Volume Kubus
Route::get('volumekubus', [App\Http\Controllers\PerhitunganController::class, 'indexKubus'])->name('volumekubus.index');

//Aksi perhitungan volume kubus
Route::post('volumekubus', [App\Http\Controllers\PerhitunganController::class, 'storeVolumeKubus'])->name('volumekubus.store');

//Tampilan form Luas Permukaan Tabung
Route::get('luaspermukaantabung', [App\Http\Controllers\PerhitunganController::class, 'indexTabung'])->name('luaspermukaantabung.index');

//Aksi perhitungan luas tabung
Route::post('luaspermukaantabung', [App\Http\Controllers\PerhitunganController::class, 'storeLuasTabung'])->name('luaspermukaantabung.store');

//limas
// Route::get('volumelimas',[App\Http\Controllers\VolumeLimasController::class, 'index'])->name('volumelimas.index'); //menampilkan form
// Route::get('volumelimas/create',[App\Http\Controllers\VolumeLimasController::class, 'create'])->name('volumelimas.create'); //menampilkan data form
// Route::post('volumelimas/store', [App\Http\Controllers\VolumeLimasController::class, 'store'])->name('volumelimas.store'); //mengisi data di tabel
// Route::get('volumelimas/edit/{id}', [App\Http\Controllers\VolumeLimasController::class, 'edit'])->name('volumelimas.edit'); // edit lalu menampilkan data
// Route::put('volumelimas/update/{id}', [App\Http\Controllers\VolumeLimasController::class, 'update'])->name('volumelimas.update'); //update data setelah diubah
// Route::delete('volumelimas/delete/{id}', [App\Http\Controllers\VolumeLimasController::class, 'destroy'])->name('volumelimas.destroy'); //delete data di tabel
route::resource('volumelimas', App\Http\Controllers\VolumeLimasController::class);

//peserta_pelatihan
route::resource('pesertapelatihan', App\Http\Controllers\PesertaPelatihanController::class);

// Route::get('pesertapelatihan', [App\Http\Controllers\VolumeLimasController::class, 'index'])->name('pesertapelatihan.index');

//belajar
route::get('belajar', [App\Http\Controllers\BelajarController::class, 'index']);
route::get('siswa', [App\Http\Controllers\BelajarController::class, 'getSiswa']);
route::get('create', [App\Http\Controllers\BelajarController::class, 'create'])->name('siswa.create');
route::post('store', [App\Http\Controllers\BelajarController::class, 'store'])->name('siswa.store');


Route::get('/', [App\Http\Controllers\LoginController::class, 'index']);
Route::post('action-login', [\App\Http\Controllers\LoginController::class, 'actionLogin'])->name('action-login');
Route::post('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::resource('user', \App\Http\Controllers\UserController::class);
Route::resource('role', \App\Http\Controllers\RoleController::class);
Route::resource('student', \App\Http\Controllers\StudentController::class);

Route::resource('attendance', \App\Http\Controllers\AttendanceController::class);

Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
// Route::get('/login')