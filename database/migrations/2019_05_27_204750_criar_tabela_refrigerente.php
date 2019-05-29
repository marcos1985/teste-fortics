<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaRefrigerente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_refrigerante', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 30);
            $table->string('sabor', 30);
            
            $table->bigInteger('id_tipo_refrigerante')->unsigned();
            $table->foreign('id_tipo_refrigerante')->references('id')->on('tb_tipo_refrigerante');

            $table->bigInteger('id_litragem')->unsigned();
            $table->foreign('id_litragem')->references('id')->on('tb_litragem_refrigerante');

            $table->integer('qtd_estoque')->unsigned();
            $table->decimal('valor_unidade',  12, 2);

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
        Schema::dropIfExists('tb_refrigerante');
    }
}
