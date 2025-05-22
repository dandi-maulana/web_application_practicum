<!-- resources/views/mahasiswa/_form.blade.php -->

<div class="form-group">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" id="nama" class="form-control"
        value="{{ $mahasiswa->nama ?? '' }}">
</div>

<div class="form-group">
    <label for="nim">NIM:</label>
    <input type="text" name="nim" id="nim" class="form-control"
        value="{{ $mahasiswa->nim ?? '' }}">
</div>

<div class="form-group">
    <label for="alamat">Alamat:</label>
    <textarea name="alamat" id="alamat" class="form-control">{{
$mahasiswa->alamat ?? '' }}</textarea>
</div>