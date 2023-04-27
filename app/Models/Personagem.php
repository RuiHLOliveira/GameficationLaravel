<?php

namespace App\Models;

use App\Models\Ideia;
use App\Models\Cobranca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personagem extends Model
{
    use HasFactory;

    protected $table = 'personagens';

    protected $attributes = [
        'exp' => '0',
        'exptotal' => '0',
        'ouro' => '0',
        'ourototal' => '0',
        'nivel' => '1',
        'prestigio' => null,
    ];

    protected $fillable = [
        'nome',
        'historia',
        'objetivos',
        'exp',
        'exptotal',
        'ouro',
        'ourototal',
        'nivel',
        'prestigio',
    ];
    
    public function ideias(): HasMany
    {
        return $this->hasMany(Ideia::class);
    }

    public function cobrancas(): HasMany
    {
        return $this->hasMany(Cobranca::class);
    }
}
