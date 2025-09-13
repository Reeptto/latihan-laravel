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
    <center>
        <h1>Tambah Kelas</h1>
        <form method="POST" action="/kelas">
            @csrf
            <input type="text" name="nama" placeholder="Nama" id=""><br><br>
            <input type="text" name="kapastas" placeholder="Kapasitas" id=""><br><br>
            <button type="submit">Simpan</button>
        </form>

        <h2>List Kelas</h2>
        <ul>
            @foreach($data as $kelas)
                <li> {{ $kelas->nama }} - {{ $kelas->kapastas }} </li>
            @endforeach
        </ul>
</body>
</html>