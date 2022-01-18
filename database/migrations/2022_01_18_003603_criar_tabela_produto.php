<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaProduto extends Migration
{
    /**
     * Executa as migrações
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->string('sku')->unique();
            $table->string('nome');
            $table->integer('quantidade_inicial');
            $table->integer('quantidade_atual');
        });
    }

    /**
     * Reverte as migrações
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto');
    }
}
