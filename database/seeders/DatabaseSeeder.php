<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Berita;
use App\Models\Gallery;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        Berita::create([
            'judul' => 'Berita 1',
            'deskripsi' => 'Deskripsi 1',
            'tanggal' => '2025-08-07',
            'foto_berita' => 'berita/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);
        Berita::create([
            'judul' => 'Berita 2',
            'deskripsi' => 'Deskripsi 2',
            'tanggal' => '2025-08-07',
            'foto_berita' => 'berita/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);
        Berita::create([
            'judul' => 'Berita 3',
            'deskripsi' => 'Deskripsi 3',
            'tanggal' => '2025-08-07',
            'foto_berita' => 'berita/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);

        
        Agenda::create([
            'judul' => 'agenda 1',
            'deskripsi' => 'Deskripsi 1',
            'tanggal' => '2025-08-07',
            'foto_agenda' => 'agenda/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);
        Agenda::create([
            'judul' => 'agenda 2',
            'deskripsi' => 'Deskripsi 2',
            'tanggal' => '2025-08-07',
            'foto_agenda' => 'agenda/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);
        Agenda::create([
            'judul' => 'agenda 3',
            'deskripsi' => 'Deskripsi 3',
            'tanggal' => '2025-08-07',
            'foto_agenda' => 'agenda/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);


        Gallery::create([
            'judul' => 'gallery 1',
            'deskripsi' => 'Deskripsi 1',
            'tanggal' => '2025-08-07',
            'foto_gallery' => 'gallery/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);
        Gallery::create([
            'judul' => 'gallery 2',
            'deskripsi' => 'Deskripsi 2',
            'tanggal' => '2025-08-07',
            'foto_gallery' => 'gallery/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);
        Gallery::create([
            'judul' => 'gallery 3',
            'deskripsi' => 'Deskripsi 3',
            'tanggal' => '2025-08-07',
            'foto_gallery' => 'gallery/ffWdw2fNDFBrfROY7lnvEjESy3BJ9LSq04CQnBGG.png',
        ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
