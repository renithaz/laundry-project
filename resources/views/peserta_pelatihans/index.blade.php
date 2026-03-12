<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Data Peserta Pelatihan</h2>
    <a href="{{ route('pesertapelatihan.create') }}">Create</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>NIK</th>
            <th>Kartu Keluarga</th>
            <th>Jenis Kelamin</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Pendidikan Terakhir</th>
            <th>Nama Sekolah</th>
            <th>Jurusan</th>
            <th>Nomor HP</th>
            <th>Email</th>
            <th>Aktivasi saat ini</th>
            <th>Action</th>
        </tr>
        @foreach ($pesertaPelatihan as $index => $v)
        
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $v->nama_lengkap }}</td>
            <td>{{ $v->nik }}</td>
            <td>{{ $v->kartu_keluarga }}</td>
            <td>{{ $v->jenis_kelamin }}</td>
            <td>{{ $v->tempat_lahir }}</td>
            <td>{{ $v->tanggal_lahir }}</td>
            <td>{{ $v->pendidikan_terakhir }}</td>
            <td>{{ $v->nama_sekolah }}</td>
            <td>{{ $v->jurusan }}</td>
            <td>{{ $v->nomor_hp }}</td>
            <td>{{ $v->email }}</td>
            <td>{{ $v->aktivasi_saat_ini }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>
