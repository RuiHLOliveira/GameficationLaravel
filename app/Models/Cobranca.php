<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cobranca extends Model
{
    use HasFactory;

    const TABLE = 'cobrancas';
    protected $table = self::TABLE;

    protected $fillable = [
        'titulo',
        'texto',
        'datadesde',
        'lembrete',
    ];

    public function personagem(): BelongsTo
    {
        return $this->belongsTo(Personagem::class);
    }
}
