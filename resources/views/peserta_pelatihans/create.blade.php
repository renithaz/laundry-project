<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Peserta Pelatihan</h3>
    <form action="{{ route('pesertapelatihan.store') }}" method="post">
        @csrf
        <label for="">Nama Lengkap</label><br>
        <input type="text" name="nama_lengkap"><br>
        <label for="">NIK</label><br>
        <input type="number" name="nik"><br>
        <label for="">Kartu Keluarga</label><br>
        <input type="number" name="kartu_keluarga"><br>
        <label for="">Jenis Kelamin</label><br>
        <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki
        <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan<br>
        <label for="">Tempat Lahir</label><br>
        <input type="text" name="tempat_lahir"><br>
        <label for="">Tanggal Lahir</label><br>
        <input type="date" name="tanggal_lahir"><br>
        <label for="">Pendidikan Terakhir</label><br>
        <input type="text" name="pendidikan_terakhir"><br>
        <label for="">Nama Sekolah</label><br>
        <input type="text" name="nama_sekolah"><br>
        <label for="">Jurusan</label><br>
        <select name="operator" required>
            <option value="">--Pilih Jurusan--</option>
            <option value="fisika">Fisika</option>
            <option value="teknikelektro">Teknik elektro</option>
            <option value="teknikkapal">Teknik Kapal</option>
            <option value="akuntasi">Akuntansi</option>
        </select><br>
        <label for="">Nomor HP</label><br>
        <input type="number" name="nomor_hp"><br>
        <label for="">Email</label><br>
        <input type="text" name="email"><br>
        <label for="">Aktivasi Saat ini</label><br>
        <input type="text" name="aktivasi_saat_ini"><br>
        
        <button type="submit">Kirim</button><br>
    </form>
</body>
</html>