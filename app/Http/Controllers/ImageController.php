<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller {

    public function displayAvatar($filename) {
        $path = Storage::path("gallery/avatars/{$filename}");
        return displayImage($path);
    }

    public function displayLogo($filename) {
        $path = Storage::path("gallery/logos/{$filename}");
        return displayImage($path);
    }

}

function displayImage($path) {
    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
}