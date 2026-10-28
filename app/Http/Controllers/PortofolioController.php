<?php
namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortofolioController extends Controller
{
    public function index()
    {
        $portofolios = Portofolio::latest()->get();

        return view('portofolio.index', compact('portofolios'));
    }

    public function create()
    {
        return view('portofolio.create');
    }
    public function edit(Portofolio $portofolio)
    {
        return view('portofolio.edit', compact('portofolio'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'teknologi' => 'nullable|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'judul',
            'deskripsi',
            'teknologi',
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('portofolio', 'public');
        }

        Portofolio::create($data);

        return redirect()
            ->route('portofolio.index')
            ->with('success', 'Portofolio berhasil ditambahkan!');
    }

    public function update(Request $request, Portofolio $portofolio)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'teknologi' => 'nullable|string|max:255',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only([
            'judul',
            'deskripsi',
            'teknologi',
        ]);

        $data['tampilkan_gambar'] = $request->boolean('tampilkan_gambar');

        if ($request->hasFile('gambar')) {
            if ($portofolio->gambar) {
                Storage::disk('public')->delete($portofolio->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('portofolio', 'public');
        }

        $portofolio->update($data);

        return redirect()
            ->route('portofolio.index')
            ->with('success', 'Portofolio berhasil diperbarui!');
    }

    public function destroy(Portofolio $portofolio)
    {
        if ($portofolio->gambar) {
            Storage::disk('public')->delete($portofolio->gambar);
        }

        $portofolio->delete();

        return redirect()
            ->route('portofolio.index')
            ->with('success', 'Portofolio berhasil dihapus!');
    }

}
