<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title')->nullable();
            $table->text('desc')->nullable();
            $table->string('rooms')->nullable();
            $table->string('price')->nullable();
            $table->string('floor')->nullable();
            $table->string('bathroom')->nullable();
            $table->string('area')->nullable();
            $table->enum('status',['without','sale','rent'])->default('without');
            $table->enum('finishing',['without','yes','no'])->default('without');
            $table->enum('activation_admin',['not_active','active'])->default('not_active');
            $table->enum('activation_user',['not_active','active'])->default('active');
            $table->enum('payment_method',['without','cash','installments'])->default('without');
            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('type_estates')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('city_id')->unsigned()->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->integer('state_id')->unsigned()->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->softDeletes();

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
        Schema::dropIfExists('units');
    }
}
