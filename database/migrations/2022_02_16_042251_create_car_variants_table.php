<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->required();
            $table->string('variant')->required();
            $table->string('type')->required();
            $table->string('file')->required();
            $table->unsignedBigInteger('car_model_id');
            $table->timestamps();

            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_variants');
    }
}
