<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        return view('Tag.index', compact('tags'));
    }

    public function destroy($id)
    {
        try {
            // Cari author berdasarkan ID dan hapus
            Tag::findOrFail($id)->delete();
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
        $tags = Tag::all();

        return view('Tag.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        // Buat tag
        $tag = Tag::create([
            'name' => $request->name,
        ]);
    
        return redirect()->route('tag.index')->with('success', 'tag berhasil dibuat!');
    }
    

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
    
        return view('Tag.edit', compact('tag'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = Tag::findOrFail($id);

        // Update data tag
        $tag->update([
            'name' => $request->name,
        ]);
        
        return redirect()->route('tag.index')->with('success', 'tag berhasil diperbarui!');
    }

}
