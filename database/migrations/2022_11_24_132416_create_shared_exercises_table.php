<?php

/**************************************************************/
/*                                                            */
/* File: 2022_11_24_132416_create_shared_exercises_table.php  */
/* Author: David Chocholaty <xbartu11@stud.fit.vutbr.cz>      */
/* Project: Project for the course ITU                        */
/* Description: The migration for creating the shared         */
/*              exercises table.                              */
/*                                                            */
/**************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The migration for creating the shared exercises table.
 */
class CreateSharedExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shared_exercises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises')
                ->onDelete('cascade');

            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shared_exercises');
    }
}
