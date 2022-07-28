<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model {

    public static $status = [
        'ADMIN' => 1,
        'MEMBER ADULT' => 2,
        'MEMBER YOUNG' => 3
    ];

}