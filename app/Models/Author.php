<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

     // Relasi satu author memiliki banyak artikel
     public function artikels()
     {
         return $this->hasMany(Artikel::class);  // Relasi one-to-many dengan Artikel
     }

     use HasFactory;

     protected $fillable = ['name', 'email'];
}
