<!-- resources/views/nilai/index.blade.php --> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Data Nilai Mahasiswa</title> 
</head> 
<body> 
    <h1>Data Nilai Mahasiswa</h1> 
    <table border="1"> 
        <thead> 
            <tr> 
                <th>No</th> 
                <th>NPM</th> 
                <th>Nama Mahasiswa</th> 
                <th>Matakuliah</th> 
                <th>Nilai</th> 
            </tr> 
        </thead> 
        <tbody> 
            @foreach ($dataNilai as $nilai) 
            <tr> 
                <td>{{ $loop->iteration }}</td> 
                <td>{{ $nilai->mahasiswa->nim }}</td> 
                <td>{{ $nilai->mahasiswa->nama }}</td> 
                <td>{{ $nilai->matakuliah->nama }}</td> 
                <td>{{ $nilai->nilai }}</td> 
            </tr> 
            @endforeach 
        </tbody> 
    </table> 
</body> 
</html>
