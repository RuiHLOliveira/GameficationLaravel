<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    use HasFactory;
    
    const TABLE = 'recursos';
    protected $table = self::TABLE;

    protected $fillable = [
        'nome',
    ];

}
