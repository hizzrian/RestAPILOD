<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class Artikel extends BaseController
{
    /**
     * Get all Artikel
     * @return Response
     */
    public function index()
    {
        $model = new ArtikelModel();
        // left join dengan table user
        $model->select('artikel.id, user.username as penulis, artikel.judul, artikel.konten, artikel.kategori, artikel.views, artikel.tanggal_publikasi, artikel.slug');
        $model->join('user', 'user.id = artikel.penulis');
        

        // add filter search
        $search = $this->request->getGet('search');
        if ($search) {
            // judul atau slug atau kategori
            $model->like('judul', $search);
            $model->orLike('slug', $search);
            $model->orLike('kategori', $search);
        }
        
        // order by
        $orderBy = $this->request->getGet('orderBy');
        if ($orderBy) {
            $model->orderBy($orderBy, 'DESC');
        }
        // where slug
        $slug = $this->request->getGet('slug');
        if ($slug) {
            $model->where('slug', $slug);
        }

        // where kategori
        $kategori = $this->request->getGet('kategori');
        if ($kategori) {
            $model->where('kategori', $kategori);
        }

        // where penulis id
        $penulis_id = $this->request->getGet('user_id');
        if ($penulis_id) {
            $model->where('penulis', $penulis_id);
        }

        $options = $this->request->getGet('options');
        if ($options) {
            // items per page
            $model->limit($options['itemsPerPage'], ($options['page'] - 1) * $options['itemsPerPage']);
        }
        $data = $model->get()->getResult();
        // format artikel.konten dont use html tag
        foreach ($data as $key => $value) {
            $data[$key]->konten = strip_tags($value->konten);
        }
        
        // die(var_dump($data));
        // get data konten from foreach
        // $konten = $data->konten;
        
        return $this->getResponse(
            [
                'message' => 'Artikel retrieved',
                'data' => $data
            ]
        );
    }
    public function getAllSlug()
    {
        $model = new ArtikelModel();
        $slug = $model->getSlug();
        return $this->getResponse(
            [
                'message' => 'Artikel retrieved',
                'slug' => $slug
            ]
        );
    }

    // get all kategori
    public function getAllKategori()
    {
        $model = new ArtikelModel();
        $kategori = $model->getKategori();
        return $this->getResponse(
            [
                'message' => 'Artikel retrieved',
                'kategori' => $kategori
            ]
        );
    }

    /**
     * Create a new Artikel
     */
    public function store()
    {
        try {
            $rules = [
                'judul' => 'required',
                'konten' => 'required|max_length[100000]',
                'kategori' => 'required|max_length[255]',
                'penulis' => 'required'
            ];

            $input = $this->getRequestInput($this->request);
            // get user id from token
            // $input['penulis'] = $this->request->getServer('HTTP_AUTHORIZATION');
            // $input['penulis'] = 1;
            if (!$this->validateRequest($input, $rules)) {
                return $this->getResponse(
                        $this->validator->getErrors(),
                        ResponseInterface::HTTP_BAD_REQUEST
                    );
            }
        // Buat slug dari judul
            $slug = url_title($input['judul'], '-', true);
            // die(var_dump($slug));
            // Masukkan slug ke dalam input sebelum menyimpan
            // slug harus unique
            $model = new ArtikelModel();
            $input['slug'] = $slug;
            $input['tanggal_publikasi'] = date('Y-m-d H:i:s');
            $model = new ArtikelModel();
            $model->save($input);
            // die(var_dump($model));
            return $this->getResponse(
                [
                    'message' => 'Artikel added successfully',
                    'artikel' => $input['judul']
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    /**
     * Get a single Artikel by ID
     */
    public function show($id = null)
    {
        try {
            // update views + 1 setiap artikel dibuka
            $model = new ArtikelModel();
            $artikel = $model->getArtikelBySlug($id);
            $artikel['views'] = $artikel['views'] + 1;
            $model->save($artikel);
            // get artikel
            $model = new ArtikelModel();
            $model->join('user', 'user.id = artikel.penulis');
            $model->select('artikel.id, user.fullname as author, artikel.judul, artikel.konten, artikel.kategori, artikel.views, artikel.tanggal_publikasi, artikel.slug');

            $artikel = $model->getArtikelBySlug($id);
            //  get konten dari artikel
            $text = $artikel['konten'];
            
            $wordsPerMinute = 200; // Ubah sesuai dengan kecepatan membaca Anda (words per minute and second
    
            $wordCount = str_word_count($text);
            // jika dibawah satu menit maka jadi kan per detik else per menit dan detik
            if ($wordCount < $wordsPerMinute) {
                $readingTimeSeconds = floor($wordCount / ($wordsPerMinute / 60));
                $readingTimeMinutes = floor($wordCount / $wordsPerMinute);
                $readingTime = $readingTimeMinutes . ' menit ' . $readingTimeSeconds . ' detik';
            } else {
                $readingTimeMinutes = floor($wordCount / $wordsPerMinute);
                $readingTimeSeconds = floor($wordCount % $wordsPerMinute / ($wordsPerMinute / 60));
                $readingTime = $readingTimeMinutes . ' menit ' . $readingTimeSeconds . ' detik';
            }
            $readingTimeMinutes = ceil($wordCount / $wordsPerMinute);
            if (!$artikel) {
                throw new Exception('Artikel not found');
            }
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => $e->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }

        return $this->getResponse(
            [
                'message' => 'Artikel retrieved',
                'artikel' => $artikel,
                'readingTime' => $readingTime
            ]
        );
    }

    public function edit($id = null)
    {
        try {
            $model = new ArtikelModel();
            $artikel = $model->findArtikel($id);
            if (!$artikel) {
                throw new Exception('Artikel not found');
            }
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => $e->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }

        return $this->getResponse(
            [
                'message' => 'Artikel retrieved',
                'artikel' => $artikel
            ]
        );
    }

    /**
     * Update a Artikel
     */
    public function update($id = null)
    {
        try {
            $model = new ArtikelModel();
            $artikel = $model->findArtikel($id);
            if (!$artikel) {
                throw new Exception('Artikel not found');
            }

            $input = $this->getRequestInput($this->request);
            $model->update($id, $input);
            $artikel = $model->findArtikel($id);

            return $this->getResponse(
                [
                    'message' => 'Artikel updated successfully',
                    'artikel' => $artikel
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => $e->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Delete a Artikel
     */
    public function delete($id = null)
    {
        try {
            $model = new ArtikelModel();
            $artikel = $model->findArtikel($id);
            if (!$artikel) {
                throw new Exception('Artikel not found');
            }
            $model->delete($artikel);

            return $this->getResponse(
                [
                    'message' => 'Artikel deleted successfully'
                ]
            );
        } catch (Exception $e) {
            return $this->getResponse(
                [
                    'message' => $e->getMessage()
                ],
                ResponseInterface::HTTP_NOT_FOUND
            );
        }
    }
}