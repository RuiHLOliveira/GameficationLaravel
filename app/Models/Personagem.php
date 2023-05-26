<?php

namespace App\Models;

use App\Models\Anotacao;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personagem extends Model
{
    use HasFactory;

    const TABLE = 'personagens';
    protected $table = self::TABLE;

    /**defaults */
    protected $attributes = [
        'nivel' => '1',
    ];

    protected $fillable = [
        'nome',
        'historia',
        'objetivos',
        'nivel',
    ];
    
    public function anotacoes(): HasMany
    {
        return $this->hasMany(Anotacao::class);
    }

}
