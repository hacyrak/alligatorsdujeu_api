<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    static public function uploadImage(String $data, $id, $prefix) {
        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);
            $type = strtolower($type[1]);
            $name = "{$prefix}_{$id}.{$type}" ;
            if (!in_array($type, [ 'jpg', 'jpeg', 'png' ])) {
                throw new \Exception('Invalid image type');
            }
            $data = str_replace( ' ', '+', $data );
            $data = base64_decode($data);
            if ($data === false) {
                throw new \Exception('Base64_decode failed');
            }
        } else {
            throw new \Exception('Did not match data URI with image data');
        }
        Storage::disk('local')->put("gallery/{$prefix}s/{$name}", $data);
        return $name;
            /*/if (file_put_contents($destination_path.$name, $data) != false) {
                return $name;
            } else {
                throw new \Exception('Unable to save image');
            }*/
    }
}
