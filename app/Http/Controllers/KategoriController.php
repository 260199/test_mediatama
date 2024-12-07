<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        return view('Kategori.index', compact('kategori'));
    }

    public function destroy($id)
    {
        try {
            // Cari author berdasarkan ID dan hapus
            Kategori::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Item berhasil dihapus.');
        } catch (QueryException $e) {
            // Tangkap kesalahan relasi (foreign key constraint)
            if ($e->getCode() == 23000) {
                return redirect()->back()->with('error', 'Data tidak dapat dihapus karena sedang digunakan di tabel lain.');
            }

            // Lempar exception jika bukan masalah relasi
            throw $e;
        }
    }

    public function create()
    {
        $kategori = kategori::all();

        return view('Kategori.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $kategori = kategori::create([
            'name' => $request->name,
        ]);
    
        return redirect()->route('kategori.index')->with('success', 'kategori berhasil dibuat!');
    }
    

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
    
        return view('Kategori.edit', compact('kategori'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $kategori = Kategori::findOrFail($id);

        // Update data kategori
        $kategori->update([
            'name' => $request->name,
        ]);
        
        return redirect()->route('kategori.index')->with('success', 'kategori berhasil diperbarui!');
    }
}