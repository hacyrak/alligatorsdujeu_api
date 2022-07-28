<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Game extends Model {
    protected $table='game';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'logo',
        'type',
        'nop_min',
        'nop_max',
        'dur_min',
        'dur_max',
        'age',
        'ean',
        'year_publication',
        'price',
        'tags',
        'collection',
        'publishers',
        'authors',
        'illustrators',
        'video_links',
        'image_links',
    ];

    /**
     * The attributes are excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = ['logo_path'];

    public function getLogoPathAttribute() {
        $file_name = $this->attributes['logo'];
        $path = Storage::path("gallery/logos/{$file_name}");
        // $url = env('APP_URL')."/storage/app/gallery/logo/{$file_name}";
        $url = env('APP_URL')."/api/v1/image/logo/{$file_name}";
          if(file_exists($path) && $file_name != null){
              return $url;
          }
          else
              return null;
    }
}