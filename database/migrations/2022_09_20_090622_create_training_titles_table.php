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
        Schema::create('training_titles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('directorate_id')->unsigned()->index();
            $table->string('title')->unique();
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
        Schema::dropIfExists('training_titles');
    }
};
