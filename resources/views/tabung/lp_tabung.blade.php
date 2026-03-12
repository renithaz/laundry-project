<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ url('navbar') }}">Back</a>
    <form action="{{ route('luaspermukaantabung.store') }}" method="post">
    @csrf
    <label for="">Jari-jari</label><br>
    <input type="number" name="jari" required><br>
    <label for="">Tinggi</label><br>
    <input type="number" name="tinggi" required><br>
    <button type="submit">Hitung</button>
    </form>
    @isset($luasTabung)      
    <h3>Hasil :{{  $luasTabung }}</h3>
    @endisset
</body>
</html>