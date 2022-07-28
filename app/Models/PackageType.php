<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageType extends Model {

    public static $type = [
        'AUCUN' => 'AUCUN',
        'MOIS' => 'MOIS',
        'SEMAINE' => 'SEMAINE',
        'ILLIMITE' => 'ILLIMITÉ',
    ];

}