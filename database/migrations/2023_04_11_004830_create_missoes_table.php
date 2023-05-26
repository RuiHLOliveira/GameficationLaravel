<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missoes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('historia');
            $table->string('descricao');
            $table->bigInteger('tipo'); //enum
            $table->dateTime('prazo');
            $table->bigInteger('situacao'); //enum
            $table->bigInteger('dificuldade'); //enum
            $table->unsignedBigInteger('historia_id')->nullable(true); //definir foreigh
            $table->unsignedBigInteger('personagem_id');
            $table->timestamps();
            // $table->foreign('historia_id')->references('id')->on('historias');
            // $table->foreign('dificuldade_id')->references('id')->on('dificuldades');
            $table->foreign('personagem_id')->references('id')->on('personagens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missoes');
    }
}
