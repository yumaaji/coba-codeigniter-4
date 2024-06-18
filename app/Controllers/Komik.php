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
}
