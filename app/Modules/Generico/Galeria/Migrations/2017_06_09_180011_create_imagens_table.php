<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'imagens', function (Blueprint $table) {
                $table->uuid('id');                
                $table->string('nome');
                $table->string('extensao', 4);
                $table->uuid('breakpoint');
                $table->uuid('galeria_id');
                $table->uuid('registro_id');
                $table->string('registro_type');
                $table->timestamps();

                $table->primary('id');

                $table->foreign(['breakpoint', 'galeria_id'])->references(['breakpoint', 'galeria_id'])
                    ->on('resolucoes')->onDelete('cascade');
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
        Schema::dropIfExists('imagens');
    }
}
