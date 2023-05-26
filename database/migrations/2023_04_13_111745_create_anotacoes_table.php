<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnotacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anotacoes', function (Blueprint $table) {
            $table->id();
            $table->datetime('lembrete');
            $table->longText('texto');
            $table->unsignedBigInteger('personagem_id');
            $table->foreign('personagem_id')->references('id')->on('personagens');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anotacoes');
    }
}
