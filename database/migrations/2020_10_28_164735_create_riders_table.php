<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('team');
            $table->foreign('team')->references('id')->on('teams');
            $table->unsignedBigInteger('engine');
            $table->foreign('engine')->references('id')->on('constructors');
            $table->string('nation');
            $table->string('date');
            $table->string('place');
            $table->string('height');
            $table->string('weight');
            $table->string('podiums');
            $table->string('wins');
            $table->string('title');
            $table->text('description');
            $table->text('picture')->nullable();
            $table->text('flag')->nullable();
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
        Schema::dropIfExists('riders');
    }
}
