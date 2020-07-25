<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trabalho');
            $table->string('avaliacao');
            $table->string('pri_bim');
            $table->string('seg_bim')->nullable();
            $table->string('ter_bim')->nullable();
            $table->string('qua_bim')->nullable();
            $table->unsignedBigInteger('disciplina_id')->references('id')->on('disciplinas');
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
        Schema::dropIfExists('pesos');
    }
}
