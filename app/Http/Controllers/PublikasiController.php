<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    /**
     * Menampilkan semua data publikasi.
     */
    public function index()
    {
        // Mengembalikan semua data dalam format JSON
        return response()->json(Publikasi::all());
    }

    /**
     * Menyimpan data publikasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'description' => 'nullable|string',
            'coverUrl' => 'nullable|url',
        ]);

        $publikasi = Publikasi::create($validated);
        
        return response()->json($publikasi, 201);
    }

    /**
     * BARU: Menampilkan detail satu publikasi.
     */
    public function show(Publikasi $publikasi)
    {
        // Laravel otomatis mencari publikasi berdasarkan ID di URL.
        // Jika tidak ketemu, otomatis akan menampilkan error 404.
        return response()->json($publikasi);
    }

    /**
     * BARU: Mengubah data publikasi yang ada.
     */
    public function update(Request $request, Publikasi $publikasi)
    {
        // Validasi input yang dikirim untuk update
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'description' => 'nullable|string',
            'coverUrl' => 'nullable|url',
        ]);

        // Lakukan update pada data yang ditemukan
        $publikasi->update($validated);

        return response()->json([
            'message' => 'Publikasi berhasil diubah!',
            'data' => $publikasi
        ]);
    }

    /**
     * BARU: Menghapus data publikasi.
     */
    public function destroy(Publikasi $publikasi)
    {
        // Hapus data dari database
        $publikasi->delete();

        return response()->json([
            'message' => 'Publikasi berhasil dihapus!'
        ]);
    }
}