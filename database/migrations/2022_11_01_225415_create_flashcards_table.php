<?php

/**********************************************************/
/*                                                        */
/* File: 2022_11_01_225415_create_flashcards_table.php    */
/* Author: David Chocholaty <xbartu11@stud.fit.vutbr.cz>  */
/* Project: Project for the course ITU                    */
/* Description: The migration for creating the flashcards */
/*              table.                                    */
/*                                                        */
/**********************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The migration for creating the flashcards table.
 */
class CreateFlashcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_id');
            $table->string('question');
            $table->string('answer');
            $table->timestamps();

            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises')
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
        Schema::dropIfExists('flashcards');
    }
}
