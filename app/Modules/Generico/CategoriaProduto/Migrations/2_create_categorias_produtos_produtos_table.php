<?php

use Kalnoy\Nestedset\NestedSet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasProdutosProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'categorias_produtos_produtos', function (Blueprint $table) {
                $table->integer('categoria_produto_id')->unsigned()->nullable();
                $table->foreign('categoria_produto_id')->references('id')
                    ->on('categorias_produtos')->onDelete('cascade');

                $table->integer('produto_id')->unsigned()->nullable();
                $table->foreign('produto_id')->references('id')
                    ->on('produtos')->onDelete('cascade');

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
        Schema::dropIfExists('categorias_produtos_produtos');
    }
}
