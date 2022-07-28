<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model {
    protected $table='family';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'newsletter',
        'philibert',
        'active',
    ];

    /**
     * The attributes are excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = ['nb_users'];

    public function users() {
        return $this->hasMany('App\Models\User');
    }

    public function subscriptions() {
        return $this->hasMany('App\Models\Subscription');
    }

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function getNbUsersAttribute()
    {
        return $this->users()->count();
    }
}