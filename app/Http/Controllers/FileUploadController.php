<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function storeFile(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Simpan file ke dalam direktori storage/app/public/uploads
        $file = $request->file('file');
        $path = $file->store('public/uploads');

        // Redirect kembali dengan pesan sukses dan path file
        return back()->with('success', 'File uploaded successfully!')
                     ->with('file', $path);
    }

    public function listFiles()

    {
        $files = Storage::files('public/uploads');
        return view('file_list', compact('files'));
    }

    public function deleteFile($filename)
    {
        Storage::delete('public/uploads/' . $filename);
        return back()->with('success', 'File deleted successfully!');
    }


}
