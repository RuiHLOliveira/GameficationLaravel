<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCobrancasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobrancas', function (Blueprint $table) {
            $table->id();
            $table->longText('titulo');
            $table->longText('texto');
            $table->dateTime('datadesde');
            $table->dateTime('lembrete');
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
        Schema::dropIfExists('cobrancas');
    }
}
