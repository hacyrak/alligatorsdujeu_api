<?php

use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('family_id')->unsigned();
            $table->foreign('family_id')->references('id')->on('family')->onUpdate('cascade');
            $table->bigInteger('package_id')->unsigned();
            $table->foreign('package_id')->references('id')->on('package')->onUpdate('cascade');
            $table->string('resume')->nullable();
            $table->boolean('terms_accepted')->default(false);
            $table->boolean('payment_method')->default(PaymentMethod::$method['espèces']);
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('subscription');
    }
}
