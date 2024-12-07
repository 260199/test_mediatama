<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Kategori;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use PhpParser\Node\UseItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = [[
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]];
        foreach($user as $key => $value){
            User::create($value);
        }

        $kategori = [[
            'name' => 'Programing',
        ],[
            'name' => 'Technologi',
        ],[
            'name' => 'Framework',

        ]];
        foreach($kategori as $key => $value){
            Kategori::create($value);
        }

        $author = [[
            'name' => 'Ilham Mubara',
            'email' => 'ilham.mubara99@gmail.com',
        ],[
            'name' => 'Nano Saputra',
            'email' => 'nanosaputra@gmail.com',

        ],[
            'name' => 'Random Saputra',
            'email' => 'random@gmail.com',
        ]];
        foreach($author as $key => $value){
            Author::create($value);
        }


        $tag = [[
            'name' => 'Laravel',
        ],[
            'name' => 'PHP',

        ],[
            'name' => 'CodeIgniter',
        ]];
        foreach($tag as $key => $value){
            Tag::create($value);
        }
    }
}
