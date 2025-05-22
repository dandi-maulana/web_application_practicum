<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request; 
use App\Models\Mahasiswa; 

class MahasiswaController extends Controller 
{ 
    public function index() 
    { 
        $mahasiswas = Mahasiswa::all(); 
        return view('mahasiswa.index', compact('mahasiswas')); 
    } 

    public function create() 
    { 
        return view('mahasiswa.create'); 
    } 

    public function store(Request $request) 
    { 
        $request->validate([ 
            'nama' => 'required|string', 
            'nim' => 'required|unique:mahasiswa,nim', 
            'alamat' => 'required|string', 
        ]); 

        Mahasiswa::create($request->all()); 

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.'); 
    } 

    public function edit(Mahasiswa $mahasiswa) 
    { 
        return view('mahasiswa.edit', compact('mahasiswa')); 
    } 

    public function update(Request $request, Mahasiswa $mahasiswa) 
    { 
        $request->validate([ 
            'nama' => 'required|string', 
            'nim' => 'required|unique:mahasiswa,nim,'.$mahasiswa->id, 
            'alamat' => 'required|string', 
        ]); 

        $mahasiswa->update($request->all()); 

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.'); 
    } 

    public function destroy(Mahasiswa $mahasiswa) 
    { 
        $mahasiswa->delete(); 

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.'); 
    } 
}
