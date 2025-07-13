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
        // Validasi dengan ketentuan tugas: hanya gambar dan maksimal 2MB
        $request->validate([
            'file' => 'required|file|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('file');
        
        // Simpan file dengan nama asli
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('public/uploads', $fileName);

        return back()->with('success', 'File uploaded successfully!')
                    ->with('file', $path)
                    ->with('fileName', $fileName);
    }

    public function listFiles()
    {
        $files = Storage::files('public/uploads');
        $fileDetails = [];

        foreach ($files as $file) {
            $fileDetails[] = [
                'name' => basename($file),
                'path' => $file,
                'size' => Storage::size($file),
                'url' => Storage::url($file),
                'lastModified' => Storage::lastModified($file)
            ];
        }

        return view('file_list', compact('fileDetails'));
    }

    public function deleteFile($filename)
    {
        $filePath = 'public/uploads/' . $filename;
        
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
            return back()->with('success', 'File deleted successfully!');
        }
        
        return back()->with('error', 'File not found!');
    }

    public function downloadFile($filename)
    {
        $filePath = 'public/uploads/' . $filename;
        
        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }
        
        return back()->with('error', 'File not found!');
    }
}