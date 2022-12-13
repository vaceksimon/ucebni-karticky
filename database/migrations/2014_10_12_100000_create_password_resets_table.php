<?php

/************************************************************/
/*                                                          */
/* File: 2014_10_12_100000_create_password_resets_table.php */
/* Author: David Chocholaty <xbartu11@stud.fit.vutbr.cz>    */
/* Project: Project for the course ITU                      */
/* Description: The migration for creating the password     */
/*              resets table (the migration is kept         */
/*              the same as was generated).                 */
/*                                                          */
/************************************************************/

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
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_resets');
    }
};
