<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaProdutoMovimento extends Migration
{
    /**
     * Executa as migrações
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_movimento', function (Blueprint $table) {
            $table->string('sku');
            $table->integer('quantidade');
            $table->string('tipo');
            $table->dateTime('data_hora')->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('sku')->references('sku')->on('produto');
        });
    }

    /**
     * Reverte as migrações
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_movimento');
    }
}
