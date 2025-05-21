<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function profil()
    {
        $data = [
            'nama' => 'Nugraha Rahmadan Diyanto',
            'npm' => '228160048'
        ];
        return view('profil', $data);
    }

    public function pendidikan()
    {
        $data = [
            'kampus' => 'Universitas Medan Area',
            'prodi' => 'Teknik Informatika'
        ];
        return view('pendidikan', $data);
    }

    public function keahlian()
    {
        $data = [
            'skill' => ['PHP', 'Laravel', 'JavaScript', 'HTML/CSS', 'Bootstrap']
        ];
        return view('keahlian', $data);
    }
}