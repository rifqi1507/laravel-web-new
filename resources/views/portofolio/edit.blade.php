<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Portofolio</title>
</head>
<body>
    <h1>Edit Projek Portofolio</h1>

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

  <form action="{{ route('portofolio.update', $portofolio->id) }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

        <p>
            <label>Judul Projek</label><br>
            <input type="text" name="judul"
                   value="{{ old('judul', $portofolio->judul) }}" required>
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" required>{{ old('deskripsi', $portofolio->deskripsi) }}</textarea>
        </p>

        <p>
            <label>Teknologi</label><br>
            <input type="text" name="teknologi"
                   value="{{ old('teknologi', $portofolio->teknologi) }}">
        </p>
        <p>
    <label>Gambar Projek</label><br>

    @if($portofolio->gambar)
        <img
            src="{{ asset('storage/' . $portofolio->gambar) }}"
            alt="{{ $portofolio->judul }}"
            style="width: 200px; display: block; margin-bottom: 10px;"
        >
    @endif

    <input type="file" name="gambar" accept=".jpg,.jpeg,.png,.webp">
    <small>Kosongkan jika tidak ingin mengganti gambar.</small>
</p>
    <p>
    <label>
        <input
            type="hidden"
            name="tampilkan_gambar"
            value="0"
        >
        <input
            type="checkbox" 
            name="tampilkan_gambar"
            value="1"
            {{ old('tampilkan_gambar', $portofolio->tampilkan_gambar) ? 'checked' : '' }}
        >
        Tampilkan gambar projek
    </label>
</p>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('portofolio.index') }}">Kembali</a>
    </form>
</body>
</html>
