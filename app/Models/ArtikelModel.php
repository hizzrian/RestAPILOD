<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class ArtikelModel extends Model
{
    protected $table = 'artikel';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul',
        'slug',
        'penulis',
        'konten',
        'tanggal_publikasi',
        'kategori',
        'views',
    ];
    protected $validationRules = [
        'judul' => 'required',
        'slug' => 'required',
        'penulis' => 'required',
        'konten' => 'required',
        'tanggal_publikasi' => 'required',
        'kategori' => 'required',
    ];
    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul harus diisi',
        ],
        'slug' => [
            'required' => 'Slug harus diisi',
        ],
        'penulis' => [
            'required' => 'Penulis harus diisi',
        ],
        'konten' => [
            'required' => 'Konten harus diisi',
        ],
        'tanggal_publikasi' => [
            'required' => 'Tanggal publikasi harus diisi',
        ],
        'kategori' => [
            'required' => 'Kategori harus diisi',
        ],
    ];

    public function getArtikel($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    // get all artikel
    public function getAllArtikel()
    {
        return $this->findAll();
    }
    public function search($keyword)
    {
        return $this->table('artikel')->like('judul', $keyword)->orLike('penulis', $keyword)->orLike('kategori', $keyword);
    }

    public function findArtikel($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function insertArtikel($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    public function updateArtikel($data, $id)
    {
        return $this->db->table($this->table)->update($data, ['id' => $id]);
    }

    public function deleteArtikel($id)
    {
        return $this->db->table($this->table)->delete(['id' => $id]);
    }
    // get all slug
    public function getSlug()
    {
        // unique slug
        return $this->db->table($this->table)->select('slug')->distinct()->get()->getResultArray();
    }

    public function getArtikelBySlug($slug)
    {
        return $this->where(['slug' => $slug])->first();
    }

    // public function countAllResults($where = false)
    // {
    //     if ($where) {
    //         return $this->db->table($this->table)->where($where)->countAllResults();
    //     }
    //     return $this->db->table($this->table)->countAllResults();
    // }
    // get total data
    public function getTotalData()
    {
        return $this->db->table($this->table)->countAllResults();
    }
    // get kategori
    public function getKategori()
    {
        // unique kategori
        return $this->db->table($this->table)->select('kategori')->distinct()->get()->getResultArray();
    }

}