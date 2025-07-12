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
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('public/uploads');

        return redirect()->route('files.list')->with('success', 'File uploaded successfully!');
    }

    public function listFiles()
    {
        $files = Storage::files('public/uploads');
        
        // Filter hanya file gambar dan PDF
        $filteredFiles = [];
        foreach ($files as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'pdf'])) {
                $url = Storage::url($file);
                
                // Debug: tampilkan URL yang dihasilkan
                // dd($url); // Uncomment ini untuk debug
                
                $filteredFiles[] = [
                    'path' => $file,
                    'name' => basename($file),
                    'url' => $url,
                    'size' => Storage::size($file),
                    'type' => $extension,
                    'full_path' => storage_path('app/' . $file), // untuk debug
                    'exists' => Storage::exists($file) // untuk debug
                ];
            }
        }
        
        return view('file_list', compact('filteredFiles'));
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
}