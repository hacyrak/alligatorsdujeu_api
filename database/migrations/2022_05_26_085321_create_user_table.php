<?php

use App\Models\UserStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('family_id')->unsigned();
            $table->foreign('family_id')->references('id')->on('family')->onUpdate('cascade');
            $table->integer('status')->unsigned()->default(UserStatus::$status['MEMBER ADULT']);
            $table->string('pseudo');
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->string('resume')->nullable();
            $table->string('avatar_path')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('user');
    }
}
