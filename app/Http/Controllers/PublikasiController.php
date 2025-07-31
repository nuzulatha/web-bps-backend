<?php
namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index()
    {
        return response()->json(Publikasi::orderBy('created_at', 'desc')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'description' => 'nullable|string',
            'coverUrl' => 'nullable|url', // Mengharapkan URL, bukan file
        ]);

        $publikasi = Publikasi::create($validated);
        
        return response()->json($publikasi, 201);
    }

    public function show(Publikasi $publikasi)
    {
        return response()->json($publikasi);
    }

    public function update(Request $request, Publikasi $publikasi)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'description' => 'nullable|string',
            'coverUrl' => 'nullable|url',
        ]);

        $publikasi->update($validated);

        return response()->json([
            'message' => 'Publikasi berhasil diubah!',
            'data' => $publikasi
        ]);
    }

    public function destroy(Publikasi $publikasi)
    {
        $publikasi->delete();

        return response()->json([
            'message' => 'Publikasi berhasil dihapus!'
        ]);
    }
}

// namespace App\Http\Controllers;

// use App\Models\Publikasi;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage; // Jangan lupa import Storage

// class PublikasiController extends Controller
// {
//     /**
//      * Menampilkan semua data publikasi.
//      */
//     public function index()
//     {
//         // Mengembalikan semua data dalam format JSON
//         // Tambahkan get() untuk mengeksekusi query
//         $publikasi = Publikasi::orderBy('created_at', 'desc')->get();
//         return response()->json($publikasi);
//     }

//     /**
//      * Menyimpan data publikasi baru.
//      */
//     public function store(Request $request)
//     {
//         // 1. Ubah aturan validasi untuk menerima file gambar
//         $validated = $request->validate([
//             'title' => 'required|string|max:255',
//             'releaseDate' => 'required|date',
//             'description' => 'nullable|string',
//             'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file 'cover'
//         ]);

//         $path = null;
//         // 2. Cek jika ada file 'cover' yang di-upload
//         if ($request->hasFile('cover')) {
//             // Simpan gambar di 'storage/app/public/covers'
//             // $path akan berisi 'covers/namafileunik.jpg'
//             $path = $request->file('cover')->store('covers', 'public');
//         }

//         // 3. Simpan path gambar ke database
//         $publikasi = Publikasi::create([
//             'title' => $validated['title'],
//             'releaseDate' => $validated['releaseDate'],
//             'description' => $validated['description'],
//             'cover_url' => $path, // Simpan path ke kolom cover_url
//         ]);
        
//         return response()->json($publikasi, 201);
//     }

//     /**
//      * Menampilkan detail satu publikasi.
//      */
//     public function show(Publikasi $publikasi)
//     {
//         return response()->json($publikasi);
//     }

//     /**
//      * Mengubah data publikasi yang ada.
//      */
//     public function update(Request $request, Publikasi $publikasi)
//     {
//         // 1. Ubah aturan validasi
//         $validated = $request->validate([
//             'title' => 'required|string|max:255',
//             'releaseDate' => 'required|date',
//             'description' => 'nullable|string',
//             'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//         ]);

//         $path = $publikasi->coverUrl; // Gunakan path lama sebagai default

//         // 2. Cek jika ada file BARU yang di-upload
//         if ($request->hasFile('cover')) {
//             // Hapus gambar lama jika ada
//             if ($publikasi->coverUrl) {
//                 Storage::disk('public')->delete($publikasi->coverUrl);
//             }
//             // Simpan gambar baru dan dapatkan path-nya
//             $path = $request->file('cover')->store('covers', 'public');
//         }

//         // 3. Update data di database dengan path yang baru
//         $publikasi->update([
//             'title' => $validated['title'],
//             'releaseDate' => $validated['releaseDate'],
//             'description' => $validated['description'],
//             'coverUrl' => $path,
//         ]);

//         return response()->json([
//             'message' => 'Publikasi berhasil diubah!',
//             'data' => $publikasi
//         ]);
//     }

//     /**
//      * Menghapus data publikasi.
//      */
//     public function destroy(Publikasi $publikasi)
//     {
//         // Hapus gambar dari storage sebelum menghapus record database
//         if ($publikasi->coverUrl) {
//             Storage::disk('public')->delete($publikasi->coverUrl);
//         }

//         $publikasi->delete();

//         return response()->json([
//             'message' => 'Publikasi berhasil dihapus!'
//         ]);
//     }
// }

// namespace App\Http\Controllers;

// use App\Models\Publikasi;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage; 

// class PublikasiController extends Controller
// {
//     /**
//      * Menampilkan semua data publikasi.
//      */
//     public function index()
//     {
//         // Mengembalikan semua data dalam format JSON
//         return response()->json(Publikasi::all());
//     }

//     /**
//      * Menyimpan data publikasi baru.
//      */
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'title' => 'required|string|max:255',
//             'releaseDate' => 'required|date',
//             'description' => 'nullable|string',
//             'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file 'cover'
//         ]);

//         $publikasi = Publikasi::create($validated);
        
//         return response()->json($publikasi, 201);
//     }

//     /**
//      * BARU: Menampilkan detail satu publikasi.
//      */
//     public function show(Publikasi $publikasi)
//     {
//         // Laravel otomatis mencari publikasi berdasarkan ID di URL.
//         // Jika tidak ketemu, otomatis akan menampilkan error 404.
//         return response()->json($publikasi);
//     }

//     /**
//      * BARU: Mengubah data publikasi yang ada.
//      */
//     public function update(Request $request, Publikasi $publikasi)
//     {
//         // Validasi input yang dikirim untuk update
//         $validated = $request->validate([
//             'title' => 'required|string|max:255',
//             'releaseDate' => 'required|date',
//             'description' => 'nullable|string',
//             'coverUrl' => 'nullable|url',
//         ]);

//         // Lakukan update pada data yang ditemukan
//         $publikasi->update($validated);

//         return response()->json([
//             'message' => 'Publikasi berhasil diubah!',
//             'data' => $publikasi
//         ]);
//     }

//     /**
//      * BARU: Menghapus data publikasi.
//      */
//     public function destroy(Publikasi $publikasi)
//     {
//         // Hapus data dari database
//         $publikasi->delete();

//         return response()->json([
//             'message' => 'Publikasi berhasil dihapus!'
//         ]);
//     }
// }