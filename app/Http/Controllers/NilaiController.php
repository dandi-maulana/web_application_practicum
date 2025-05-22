<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Nilai;

class NilaiController extends Controller
{
    public function index()
    {
        $dataNilai = Nilai::with(['mahasiswa', 'matakuliah'])->get();
        return view('datanilai', compact('dataNilai'));
    }

    public function showNilaiMahasiswa($mahasiswaId)
    {
        $mahasiswa = Mahasiswa::with('nilai.matakuliah')->find($mahasiswaId);

        if (!$mahasiswa) {
            return view('nilai.not_found');
        }

        return view('nilai.show', compact('mahasiswa'));
    }
}