<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

      protected $fillable = ['name', 'content', 'author_id'];

      public function author()
      {
          return $this->belongsTo(Author::class);
      }
  
      public function categories()
      {
          return $this->hasMany(ArtikelKategori::class, 'artikel_id')->with('kategori');
      }
  
      public function tags()
      {
          return $this->hasMany(ArtikelTag::class, 'artikel_id')->with('tag');
      }

          // Event boot untuk menghapus data terkait
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($artikel) {
            // Hapus data artikel_kategori terkait
            $artikel->categories()->delete();
            // Hapus data artikel_tag terkait
            $artikel->tags()->delete();
        });
    }
}
