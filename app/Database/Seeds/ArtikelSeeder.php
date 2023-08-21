<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run()
    {
        
        $data = [];

        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'judul' => 'Artikel ' . $i,
                'slug' => 'artikel-' . $i,
                'penulis' => 'Penulis ' . rand(1, 5),
                'konten' => 'Ini adalah konten artikel ' . $i,
                'tanggal_publikasi' => date('Y-m-d', strtotime('-' . rand(1, 30) . ' days')),
                'kategori' => 'Kategori ' . rand(1, 3),
                'views' => rand(10, 500), // Jumlah views
            ];
        }

        $this->db->table('artikel')->insertBatch($data);

    }
}
