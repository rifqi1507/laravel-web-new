<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Portofolio</title>
</head>
<body>
    <h1>Tambah Projek Portofolio</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('portofolio.store') }}"
      method="POST"
      enctype="multipart/form-data">
        @csrf

        <p>
            <label>Judul Projek</label><br>
            <input type="text" name="judul"
                   value="{{ old('judul') }}" required>
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" required>{{ old('deskripsi') }}</textarea>
        </p>

        <p>
            <label>Teknologi</label><br>
            <input type="text" name="teknologi"
                   value="{{ old('teknologi') }}">
        </p>

        <p>
    <label>Gambar Projek</label><br>
    <input type="file" name="gambar" accept="image/*">
</p>

        <button type="submit">Simpan Projek</button>
        <a href="{{ route('portofolio.index') }}">Kembali</a>
    </form>
</body>
</html>
