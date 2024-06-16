<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(){
      $data = [
        'title' => 'Home'
      ];
      return view('pages/home', $data);
    }
      
    public function about(){
        $data = [
          'title' => 'About'
        ];
        return view('pages/about', $data);
    }
          
    public function contact(){
        $data = [
          'title' => 'Contact',
          'contacts' => [
            [
              'name' => 'Fikri',
              'phone' => '08123456789'
            ],
            [
              'name' => 'Daffa',
              'phone' => '08123456789'
            ],
            [
              'name' => 'Putri',
              'phone' => '08123478880'
            ]
          ]
        ];
        
        return view('pages/contact', $data);
    }
}
