<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'mimetypes:application/nappdf,application/pdf,image/png,image/jpeg'
        ]);

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        // $mime = $file->getMimeType();
        // $size = $file->getSize();
        $path = $file->store('public/' . date('Y/m/d'));

        return [
            'filename' => $name,
            'path' => $path,
            'user_id' => $request->user()->id
        ];
    }
}
