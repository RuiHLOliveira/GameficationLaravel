<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorBase extends Model
{
    use HasFactory;
    
    protected $table = 'valoresbases';

    protected $attributes = [
        'expAvancarNivel' => 100,
        'ouroMaximoMissao' => 100,
    ];
}
