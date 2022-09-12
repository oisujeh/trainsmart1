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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('sex');
            $table->string('designation');
            $table->string('category');
            $table->string('photo_consent');
            $table->unsignedBigInteger('institution_id')->unsigned()->index();
            $table->unsignedBigInteger('directorate_id')->unsigned()->index();
            $table->foreign('institution_id')->references('id')->on('institutions');
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
        Schema::dropIfExists('participants');
    }
};
