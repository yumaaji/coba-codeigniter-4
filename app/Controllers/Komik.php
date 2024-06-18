<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{    
    protected $komikModel;

    public function __construct() {
      $this->komikModel = new KomikModel();
    }

    public function index(): string
    { 
      $dataKomik = $this->komikModel->getKomik();

      $data = [
        'title' => 'Daftar Komik',
        'komik' => $dataKomik 
      ];
        return view('komik/index', $data);
    }

    public function detail($slug) {
      $data = [
        'title' => 'Detail Komik',
        'komik' => $this->komikModel->getKomik($slug)
      ];

      return view('komik/detail', $data);
    }

    public function create() {
      $data = [
        'title' => 'Form Tambah Data',
        'validation' => session()->getFlashdata('validation')
      ];

      return view('komik/create', $data);
    }

    public function store() {
      if (!$this->validate([
        'judul' => ['required', 'is_unique[komik.judul]'],
        'penulis' => 'required',
        'penerbit' => 'required',
        'sampul' => 'required'

      ],[
        'judul' => [
          'required' => 'Judul harus diisi',
          'is_unique' => 'Judul sudah terdaftar',
        ],
        'penulis' => [
          'required' => 'Penulis harus diisi',
        ],
        'penerbit' => [
          'required' => 'Penerbit harus diisi',
        ],
        'sampul' => [
          'required' => 'Sampul harus diisi',
        ],
      ])){
        $validation = \Config\Services::validation();

        return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
      }

      $slug = url_title($this->request->getVar('judul'), '-', true);
      $this->komikModel->save([
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $this->request->getVar('sampul'),
      ]);

      session()->setFlashdata('success', 'Data berhasil ditambahkan');
      return $this->response->redirect('/komik');
    }
    
}
