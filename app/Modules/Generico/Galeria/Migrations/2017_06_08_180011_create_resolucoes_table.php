<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResolucoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'resolucoes', function (Blueprint $table) {
                $table->string('breakpoint', 2);
                $table->integer('altura')->nullable();
                $table->integer('largura')->nullable();
                $table->uuid('galeria_id');
                $table->timestamps();

                $table->primary(['breakpoint', 'galeria_id']);

                $table->foreign('galeria_id')->references('id')
                    ->on('galerias')->onDelete('cascade');
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
        Schema::dropIfExists('resolucoes');
    }
}
