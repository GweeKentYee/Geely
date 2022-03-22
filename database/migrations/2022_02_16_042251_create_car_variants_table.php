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
            $table->string('variant')->required();
            $table->string('type')->required();
            $table->string('transmission')->required();
            $table->string('fuel')->required();
            $table->string('specs_file')->required();
            $table->string('data_file')->required();
            $table->unsignedBigInteger('car_model_id');
            $table->timestamps();

            $table->foreign('car_brand_id')->references('id')->on('car_brands')->onDelete('cascade');
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
