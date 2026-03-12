<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaPelatihan extends Model
{
    protected $table = 'peserta_pelatihans';
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'kartu_keluarga',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'nama_sekolah',
        'jurusan',
        'nomor_hp',
        'email',
        'aktivasi_saat_ini',    
    ];
}
