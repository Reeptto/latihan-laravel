<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data mahasiswa</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
        <h1>Tambah Mahasiswa</h1>
        <form method="POST" action="/mahasiswa">
            @csrf
            <input type="text" name="nama" placeholder="Nama" id=""><br>
            <input type="text" name="nim" placeholder="Nim" id=""><br>
            <button type="submit">Simpan</button>
        </form>

        <h2>List Mahasiswa</h2>
        <ul>
            @foreach($data as $mhs)
                <li> {{ $mhs->nama }} - {{ $mhs->nim }} </li>
            @endforeach
        </ul>
</body>
</html>