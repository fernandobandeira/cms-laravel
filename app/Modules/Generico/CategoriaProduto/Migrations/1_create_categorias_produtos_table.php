<?php

use Kalnoy\Nestedset\NestedSet;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'categorias_produtos', function (Blueprint $table) {
                $table->increments('id');
                $table->uuid('uuid');
                $table->boolean('ativo')->nullable()->default(false);
                $table->string('nome', 150);
                $table->string('slug', 150)->nullable();
                NestedSet::columns($table);
                $table->softDeletes();
                $table->timestamps();

                $table->unique('uuid');
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
        Schema::dropIfExists('categorias_produtos');
    }
}
