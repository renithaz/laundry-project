<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>Create Volume Limas Segiempat</h3>
    <form action="{{ route('volumelimas.store') }}" method="post">
        @csrf
        <label for="">Luas Alas</label><br>
        <input type="number" step="any" name="luas_alas" required><br>
        <label for="">Tinggi</label><br>
        <input type="number" step="any" name="tinggi" required><br>
        <button type="submit">Hitung & Simpan</button>
    </form>
</body>
</html>