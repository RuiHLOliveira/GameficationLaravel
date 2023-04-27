<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personagens', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('historia');
            $table->text('objetivos');
            $table->unsignedBigInteger('exp')->default(0);
            $table->unsignedBigInteger('exptotal')->default(0);
            $table->unsignedBigInteger('ouro')->default(0);
            $table->unsignedBigInteger('ourototal')->default(0);
            $table->unsignedBigInteger('nivel')->default(1);
            $table->integer('prestigio')->nullable();
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
        Schema::dropIfExists('personagens');
    }
}
