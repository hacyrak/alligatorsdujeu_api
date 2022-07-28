<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {

    public static $method = [
        'espèces' => 1,
        'chèque' => 2,
        'cb' => 3,
        'paypal' => 4,
    ];

}