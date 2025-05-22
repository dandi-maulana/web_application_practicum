<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use App\Models\Nilai; 

class NilaiController extends Controller 
{ 
    public function index() 
    { 
        $dataNilai = Nilai::with(['mahasiswa', 'matakuliah'])->get(); 

        return view('datanilai', compact('dataNilai')); 
    } 
}
