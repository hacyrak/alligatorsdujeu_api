<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Package extends Model {
    protected $table = 'package';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type',
        'count',
        'resume',
        'price',
        'deleted_at'
    ];

    /**
     * The attributes are excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = ['nb_families'];

    public function subscriptions() {
        return $this->hasMany('App\Models\Subscription')->where('deleted_at','>=',Carbon::now())->orderBy('deleted_at');
    }

       public function getTitleAttribute($value)
    {
        return strtoupper($value);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

    public function getNbFamiliesAttribute()
    {

        return $this->subscriptions()->where('deleted_at','>=',Carbon::now())->count();
    }
}