<?php

namespace App\Controllers;

use App\Models\KomikModel;
use COM;
use PSpell\Config;

class Komik extends BaseController
{    
    protected $komikModel;

    public function __construct() {
      $this->komikModel = new KomikModel();
    }

    public function index(): string{ 
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
      // session();
      $validation = \Config\Services::validation();

      $data = [
        'title' => 'Form Tambah Data',
        'validation' => $validation
      ];

      return view('komik/create', $data);
    }

    public function store() {
      if (!$this->validate([
        'judul' => ['required', 'is_unique[komik.judul]'],
        'penulis' => 'required',
        'penerbit' => 'required',
        'sampul' => ['mime_in[sampul,image/jpg,image/jpeg,image/png]','ext_in[sampul,png,jpg]','max_size[sampul,1024]']

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
          'mime_in' => 'Yang anda pilih bukan gambar',
          'max_size' => 'Ukuran gambar terlalu besar',
          'ext_in' => 'Yang anda pilih bukan gambar',
        ],
      ])){
        $validation = \Config\Services::validation();
        session()->getFlashdata('error', $validation->getErrors());
        return redirect()->to('/komik/create')->withInput();
      }
      // ambil gambar
      $fileSampul = $this->request->getFile('sampul');
      if ($fileSampul->getError() == 4) {
        $fileName = 'default.png';
      } else {
        $fileName = $fileSampul->getRandomName();
        $fileSampul->move('img', $fileName);
      }

      $slug = url_title($this->request->getVar('judul'), '-', true);
      $this->komikModel->save([
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $fileName,
      ]);

      session()->setFlashdata('success', 'Data berhasil ditambahkan');
      return $this->response->redirect('/komik');
    } 

    public function edit($slug){
      $data = [
        'title' => 'Edit Komik',
        'komik' => $this->komikModel->getKomik($slug),
        'validation' => session()->getFlashdata('validation')
      ];

      return view('komik/edit', $data);
    }

    public function update($id){
      
      $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
      if($komikLama['slug'] == $this->request->getVar('slug')){
        $rule_judul = 'required';
      }else{
        $rule_judul = 'required|is_unique[komik.judul]';
      }

      if (!$this->validate([
        'judul' => $rule_judul,
        'penulis' => 'required',
        'penerbit' => 'required',
        'sampul' => ['mime_in[sampul,image/jpg,image/jpeg,image/png]','ext_in[sampul,png,jpg]','max_size[sampul,1024]']
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
          'mime_in' => 'Yang anda pilih bukan gambar',
          'max_size' => 'Ukuran gambar terlalu besar',
          'ext_in' => 'Yang anda pilih bukan gambar',
        ],
      ])){

        $validation = \Config\Services::validation();
        return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
      }

      // ambil gambar
      $fileSampul = $this->request->getFile('sampul');
      if($fileSampul->getError() == 4){
        $namaSampul = $this->request->getVar('sampulLama');
      }else{
        $namaSampul = $fileSampul->getRandomName();
        $fileSampul->move('img', $namaSampul);

        unlink('img/'. $this->request->getVar('sampulLama'));
      }

      $slug = url_title($this->request->getVar('judul'), '-', true);
      $this->komikModel->save([
        'id' => $id,
        'judul' => $this->request->getVar('judul'),
        'slug' => $slug,
        'penulis' => $this->request->getVar('penulis'),
        'penerbit' => $this->request->getVar('penerbit'),
        'sampul' => $namaSampul,
      ]);

      session()->setFlashdata('success', 'Data berhasil diupdate');
      return $this->response->redirect('/komik');
    }

    public function delete($id_komik){
      $komik = $this->komikModel->find($id_komik);

      if ( $komik['sampul'] != 'default.png'){
        unlink('img/' . $komik['sampul']);
      }
      $this->komikModel->delete($id_komik);
      session()->setFlashdata('success', 'Data berhasil dihapus');
      return $this->response->redirect('/komik');
    }
    
}
