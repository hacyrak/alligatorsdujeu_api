<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('nop_min')->unsigned()->nullable();
            $table->bigInteger('nop_max')->unsigned()->nullable();
            $table->bigInteger('dur_min')->unsigned()->nullable();
            $table->bigInteger('dur_max')->unsigned()->nullable();
            $table->bigInteger('age')->unsigned()->nullable();
            $table->bigInteger('ean')->unsigned()->nullable();
            $table->year('year_publication')->unsigned()->nullable();
            $table->float('price')->default(0)->nullable();
            $table->string('tags')->nullable();
            $table->string('collection')->nullable();
            $table->string('publishers')->nullable();
            $table->string('authors')->nullable();
            $table->string('illustrators')->nullable();
            $table->string('video_links')->nullable();
            $table->string('image_links')->nullable();
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
        Schema::dropIfExists('game');
    }
}
