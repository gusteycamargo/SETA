<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConceitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceitos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
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
        Schema::dropIfExists('conceitos');
    }
}
