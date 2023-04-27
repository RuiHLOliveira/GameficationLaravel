<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Missao extends Model
{
    use HasFactory;

    const TIPO_DIARIA = 1;
    const TIPO_SEMANAL = 2;
    const TIPO_UNICA = 3;

    const SITUACAO_ATIVA = 1;
    const SITUACAO_PAUSADA = 2;
    const SITUACAO_FALHA = 3;

    const TABLE = 'missoes';
    protected $table = self::TABLE;

    protected $fillable = [
        'titulo',
        'descricao',
        'tipo',
        'prazo',
        'situacao',
        // 'historia_id',
        // 'dificuldade_id',
        // 'personagem_id',
    ];

    public function personagem(): BelongsTo
    {
        return $this->belongsTo(Personagem::class);
    }
}
