
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Saya</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
        }
        .primary { background: #2563eb; }
        .edit { background: #d97706; }
        .delete { background: #dc2626; }
        .card {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 10px;
        }
        .success {
            background: #dcfce7;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }
        .actions {
            display: flex;
            gap: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Portofolio Rifqi Aunur Rahman</h1>
                <p>Daftar projek yang pernah saya kerjakan.</p>
            </div>
            <a href="{{ route('portofolio.create') }}" class="btn primary">
                + Tambah Projek
            </a>
        </div>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif



@forelse($portofolios as $item)
    <div class="card">

        @if($item->gambar && $item->tampilkan_gambar)
            <img
                src="{{ asset('storage/' . $item->gambar) }}"
                alt="{{ $item->judul }}"
                style="width: 200px; height: auto; border-radius: 10px; margin-bottom: 15px;"
            >
        @endif

        <h2>{{ $item->judul }}</h2>


                @if($item->teknologi)
                    <p><strong>Teknologi:</strong> {{ $item->teknologi }}</p>
                @endif

                <div class="actions">
                    <a href="{{ route('portofolio.edit', $item->id) }}"
                       class="btn edit">Edit</a>

                    <form action="{{ route('portofolio.destroy', $item->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus projek ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="card">
                Belum ada data portofolio. Silakan tambah projek pertama lu!
            </div>
        @endforelse
    </div>
</body>
</html>
