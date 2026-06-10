<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FileStore;

class UploadController extends Controller
{
    public function uploadChunk(Request $request)
    {
        $chunk       = $request->file('file');
        $chunkNumber = $request->resumableChunkNumber;
        $identifier  = $request->resumableIdentifier;

        $chunkPath = storage_path("app/chunks/{$identifier}/");
        if (!FileStore::isDirectory($chunkPath)) {
            FileStore::makeDirectory($chunkPath, 0777, true, true);
        }

        $chunk->move($chunkPath, "chunk_{$chunkNumber}");

        return response()->json(['status' => 'ok']);
    }

    public function mergeChunks(Request $request)
    {
        try {
            $identifier  = $request->identifier;
            $fileName    = time() . '_' . $request->filename;
            $totalChunks = $request->totalChunks;
            $chunkPath   = storage_path("app/chunks/{$identifier}/");
            $chunkFiles  = FileStore::files($chunkPath);
            $totalChunks = count($chunkFiles);
            $tempPath    = public_path("temp_upload");
            $outputPath  = public_path("temp_upload/{$fileName}");

            if (!FileStore::isDirectory($tempPath)) {
                FileStore::makeDirectory($tempPath, 0777, true, true);
            }

            $output = fopen($outputPath, 'wb');
            for ($i = 1; $i <= $totalChunks; $i++) {
                $chunkFile = $chunkPath . DIRECTORY_SEPARATOR . "chunk_{$i}";
                $chunk = fopen($chunkFile, 'rb');
                stream_copy_to_stream($chunk, $output);
                fclose($chunk);
                FileStore::delete($chunkFile);
            }

            fclose($output);
            if (FileStore::isDirectory($chunkPath)) {
                FileStore::deleteDirectory($chunkPath);
            }

            $getID3   = new \getID3;
            $fileInfo = $getID3->analyze($outputPath);
            $duration = isset($fileInfo['playtime_seconds']) ? floor($fileInfo['playtime_seconds']) : 0;

            return response()->json([
                'status'   => 'success',
                'filename' => $fileName,
                'duration' => $duration,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ], 500);
        }
    }
}
