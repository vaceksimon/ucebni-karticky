<?php

/*******************************************************************/
/*                                                                 */
/* File: 2019_12_14_000001_create_personal_access_tokens_table.php */
/* Author: David Chocholaty <xbartu11@stud.fit.vutbr.cz>           */
/* Project: Project for the course ITU                             */
/* Description: The migration for creating the personal access     */
/*              tokens table.                                      */
/*                                                                 */
/*******************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The migration for creating the personal access tokens table.
 */
class CreatePersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('degree_front')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('degree_after')->nullable();
            $table->enum('account_type', ['admin', 'teacher', 'student']);
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
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
        Schema::dropIfExists('personal_access_tokens');
    }
}
