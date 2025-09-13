<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data mata kuliah</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <center>
        <h1>Tambah Mata kuliah</h1>
        <form method="POST" action="/matkul">
            @csrf
            <input type="text" name="nama" placeholder="Nama" id=""><br><br>
            <input type="text" name="deskripsi" placeholder="Deskripsi" id=""><br><br>
            <button type="submit">Simpan</button>
        </form>

        <h2>List Mata kuliah</h2>
        <ul>
            @foreach($data as $matkul)
                <li> {{ $matkul->nama }} - {{ $matkul->deskripsi }} </li>
            @endforeach
        </ul>
</body>
</html>