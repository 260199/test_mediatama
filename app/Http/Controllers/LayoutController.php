<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Author;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function index(){
        $artikel = Artikel::with(['author', 'categories.kategori', 'tags.tag'])->get();
        return view('home')->with([
            'users'  => Auth::user(),
            'artikel' => $artikel
            ]);
    }

    public function dashboard()
    {
        // Mengambil data artikel beserta penulisnya
        $artikel = Artikel::with('author')->get();  // Mengambil artikel beserta authornya
        $kategori = Kategori::all(); 
        $tag = Tag::all();           
        $authors = Author::all();    
    
        $artikelCount = Artikel::count();   
        $kategoriCount = Kategori::count(); 
        $tagCount = Tag::count();           
        $authorCount = Author::count();    
    
        return view('dashboard', compact('artikel', 'kategori', 'tag', 'authors', 'artikelCount', 'kategoriCount', 'tagCount', 'authorCount'));
    }
    


}


// public function index(){
//     $count = Barang::count();
//     $count2 = Kantor::count();
//     $count3 = PermintaanBarang::count();
//     $count4 = Norek::count();
//     return view('layouts.home')->with([
//         'user'=> Auth::user(),
//         'barang' => $count,
//         'kantor' => $count2,
//         'permintaan' => $count3,
//         'norek' => $count4
//     ]);
// }
