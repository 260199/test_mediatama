<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class AuthorController extends Controller
{
    public function index()
    {
        $author = Author::all();

        return view('Author.index', compact('author'));
    }

   
    public function destroy($id)
    {
        try {
            // Cari author berdasarkan ID dan hapus
            Author::findOrFail($id)->delete();
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
        $author = Author::all();

        return view('Author.create', compact('author'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        $author = Author::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        return redirect()->route('author.index')->with('success', 'author berhasil dibuat!');
    }
    

    public function edit($id)
    {
        $author = Author::findOrFail($id);
    
        return view('Author.edit', compact('author'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        $author = Author::findOrFail($id);

        // Update data author
        $author->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        
        return redirect()->route('author.index')->with('success', 'author berhasil diperbarui!');
    }

}