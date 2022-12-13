<?php

/***************************************************************/
/*                                                             */
/* File: 2022_11_22_154052_create_assigned_exercises_table.php */
/* Author: David Chocholaty <xbartu11@stud.fit.vutbr.cz>       */
/* Project: Project for the course ITU                         */
/* Description: The migration for creating the assigned        */
/*              exercises table.                               */
/*                                                             */
/***************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The migration for creating the assigned exercises table.
 */
class CreateAssignedExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assigned_exercises', function (Blueprint $table) {
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
        Schema::dropIfExists('assigned_exercises');
    }
}
