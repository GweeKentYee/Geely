<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsedCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('used_cars', function (Blueprint $table) {

            $table->id();
            $table->integer('min_price');
            $table->integer('max_price');
            $table->string('registration')->unique();
            $table->string('data_file')->required();
            $table->string('ownership_file')->required();
            $table->integer('status')->required();
            $table->unsignedBigInteger('car_id');
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('used_cars');
    }
}
