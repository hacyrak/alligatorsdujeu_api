<?php

namespace App\Models;

use Auth0\SDK\API\Management\Logs;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Subscription extends Model {
    protected $table = 'subscription';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'family_id',
        'package_id',
        'resume',
        'terms_accepted',
        'payment_method',
        'deleted_at',
        'created_at',
    ];

    /**
     * The attributes are excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['family_id', 'package_id'];

    public function family() {
        return $this->belongsTo('App\Models\Family');
    }

    public function package() {
        return $this->belongsTo('App\Models\Package');
    }

}