<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ideia extends Model
{
    use HasFactory;

    const TABLE = 'ideias';
    protected $table = self::TABLE;

    protected $fillable = [
        'titulo',
        'texto',
    ];

    public function personagem(): BelongsTo
    {
        return $this->belongsTo(Personagem::class);
    }
}
