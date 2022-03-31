<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_model_id')->required();
            $table->unsignedBigInteger('car_variant_id')->required();
            $table->unsignedBigInteger('car_body_type_id')->required();
            $table->unsignedBigInteger('car_general_spec_id')->required();
            $table->integer('year')->required();
            $table->string('spec_file');
            $table->string('data_file')->required();

            $table->foreign('car_model_id')->references('id')->on('car_models')->onDelete('cascade');
            $table->foreign('car_variant_id')->references('id')->on('car_variants')->onDelete('cascade');
            $table->foreign('car_body_type_id')->references('id')->on('car_body_types')->onDelete('cascade');
            $table->foreign('car_general_spec_id')->references('id')->on('car_general_specs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
