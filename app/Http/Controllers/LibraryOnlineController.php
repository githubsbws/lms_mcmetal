<?php

namespace App\Http\Controllers;

use App\Models\LibraryFile;
use Illuminate\Http\Request;

class LibraryOnlineController extends Controller
{
    public function index()
    {
        $libraryFiles = LibraryFile::where('active','y')->get();
        return view('index.library.library-online',compact('libraryFiles'));
    }

    public function viewFile(int $id)
    {
        $file = LibraryFile::findOrFail($id);
        $file->increment('view');

        $path = storage_path('app/public/library/' . $file->filename);
        if (!file_exists($path)) abort(404);

        $extension = strtolower(pathinfo($file->filename, PATHINFO_EXTENSION));
        $mimeType  = match($extension) {
            'pdf' => 'application/pdf',
            'mp4' => 'video/mp4',
            default => mime_content_type($path)
        };

        return response()->file($path, [
            'Content-Type'        => $mimeType,
            'Content-Disposition' => 'inline',
        ]);
    }
}
