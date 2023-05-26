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
    
    const DIFICULDADE_BAIXA = 1;
    const DIFICULDADE_MEDIA = 2;
    const DIFICULDADE_ALTA = 3;

    const TABLE = 'missoes';
    protected $table = self::TABLE;

    protected $fillable = [
        'titulo',
        'historia',
        'descricao',
        'tipo',
        'prazo',
        'situacao',
    ];

    public function personagem(): BelongsTo
    {
        return $this->belongsTo(Personagem::class);
    }

    public static function getEnumTipos(){
        return [
            self::TIPO_DIARIA,
            self::TIPO_SEMANAL,
            self::TIPO_UNICA,
        ];
    }
    
    public static function getEnumSituacoes(){
        return [
            self::SITUACAO_ATIVA,
            self::SITUACAO_PAUSADA,
            self::SITUACAO_FALHA,
        ];
    }

    public static function getEnumDificuldades(){
        return [
            self::DIFICULDADE_BAIXA,
            self::DIFICULDADE_MEDIA,
            self::DIFICULDADE_ALTA,
        ];
    }
}
