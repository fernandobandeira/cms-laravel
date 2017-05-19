<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'produtos', function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('ativo')->nullable()->default(false);
                $table->boolean('disponivel')->nullable()->default(false);
                $table->boolean('destaque')->nullable()->default(false);
                $table->string('nome', 70);
                $table->string('slug', 150)->nullable();
                $table->string('referencia', 45)->nullable();
                $table->text('descricao')->nullable();
                $table->integer('ordem')->nullable();
                $table->softDeletes();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
