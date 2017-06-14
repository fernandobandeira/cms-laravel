<?php

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
                $table->uuid('id');
                $table->boolean('ativo')->nullable()->default(false);
                $table->string('nome', 150);
                $table->string('slug', 150)->nullable();
                $table->unsignedInteger('_lft');
                $table->unsignedInteger('_rgt');
                $table->uuid('parent_id')->nullable();
                $table->softDeletes();
                $table->timestamps();

                $table->primary('id');
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
