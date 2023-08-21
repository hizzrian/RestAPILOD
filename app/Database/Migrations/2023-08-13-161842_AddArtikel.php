<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddArtikel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'penulis' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'konten' => [
                'type' => 'TEXT',
            ],
            'tanggal_publikasi' => [
                'type' => 'DATE',
            ],
            'kategori' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'views' => [
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'default' => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('artikel');
    }

    public function down()
    {
        //
        $this->forge->dropTable('artikel');
    }
}
