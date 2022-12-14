<?php

/************************************************************/
/*                                                          */
/* File: 2019_08_19_000000_create_failed_jobs_table.php     */
/* Author: David Chocholaty <xbartu11@stud.fit.vutbr.cz>    */
/* Project: Project for the course ITU                      */
/* Description: The migration for creating the failed       */
/*              jobs table (the migration is kept           */
/*              the same as was generated).                 */
/*                                                          */
/************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The migration for creating the failed jobs table.
 */
class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}
