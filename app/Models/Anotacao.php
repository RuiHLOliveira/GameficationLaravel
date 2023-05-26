<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anotacao extends Model
{
    use HasFactory;

    const TABLE = 'anotacoes';
    protected $table = self::TABLE;

    protected $fillable = [
        'texto',
        'lembrete',
    ];

    public function personagem(): BelongsTo
    {
        return $this->belongsTo(Personagem::class);
    }
}
