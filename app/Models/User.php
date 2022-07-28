<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class User extends Model {
    protected $table = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'family_id',
        'status',
        'pseudo',
        'password',
        'email',
        'phone',
        'birthday',
        'resume',
        'avatar_path',
        'active',
        
    ];

    /**
     * The attributes are excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['family_id',];

    protected $appends = ['age','avatar'];

    public function family() {
        return $this->belongsTo('App\Models\Family');
    }

    public function getPseudoAttribute($value)
    {
        return strtolower($value);
    }

    public function setPseudoAttribute($value)
    {
        $this->attributes['pseudo'] = strtolower($value);
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }

    public function getAvatarAttribute() {
        $file_name = $this->attributes['avatar_path'];
        $path = Storage::path("gallery/avatars/{$file_name}");
         $url = env('APP_URL')."/api/v1/image/avatar/{$file_name}";
         
          if(file_exists($path) && $file_name != null){
              return $url;
          }
          else
              return null;
    }

}