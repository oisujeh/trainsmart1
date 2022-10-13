<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_title_id');
            $table->unsignedBigInteger('directorate_id');
            $table->string('location');
            $table->string('method');
            $table->string('venue');
            $table->date('start_date');
            $table->date('end_date');
            $table->foreign('training_title_id')->references('id')->on('training_titles');
            $table->foreign('directorate_id')->references('id')->on('directorates');
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
        Schema::dropIfExists('trainings');
    }
};
