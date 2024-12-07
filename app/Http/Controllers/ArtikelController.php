<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Author;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        $artikels = Artikel::with(['author', 'categories.kategori', 'tags.tag'])->get();

        return view('Artikel.index', compact('artikels'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Kategori::all();
        $tags = Tag::all();

        return view('Artikel.create', compact('authors', 'categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'category' => 'required|exists:kategoris,id',
            'tag' => 'nullable|exists:tags,id',
        ]);
    
        // Buat artikel
        $artikel = Artikel::create([
            'name' => $request->name,
            'content' => $request->content,
            'author_id' => $request->author_id,
        ]);
    
        // Simpan kategori ke ArtikelKategori
        $artikel->categories()->create(['kategori_id' => $request->category]);
    
        // Simpan tag ke ArtikelTag (jika ada)
        if ($request->tag) {
            $artikel->tags()->create(['tag_id' => $request->tag]);
        }
    
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dibuat!');
    }
    

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
    
        // Hapus artikel beserta relasi terkait
        $artikel->delete();
    
        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }


    public function edit($id)
    {
        $artikel = Artikel::with(['categories', 'tags'])->findOrFail($id);
        $authors = Author::all();
        $categories = Kategori::all();
        $tags = Tag::all();

        return view('Artikel.edit', compact('artikel', 'authors', 'categories', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'author_id' => 'required|exists:authors,id',
            'category' => 'required|exists:kategoris,id',
            'tag' => 'nullable|exists:tags,id',
        ]);

        $artikel = Artikel::findOrFail($id);

        // Update data artikel
        $artikel->update([
            'name' => $request->name,
            'content' => $request->content,
            'author_id' => $request->author_id,
        ]);

        // Update kategori (hapus yang lama, tambahkan yang baru)
        $artikel->categories()->delete();
        $artikel->categories()->create(['kategori_id' => $request->category]);

        // Update tag (hapus yang lama, tambahkan yang baru)
        $artikel->tags()->delete();
        if ($request->tag) {
            $artikel->tags()->create(['tag_id' => $request->tag]);
        }

        return redirect()->route('artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }
}