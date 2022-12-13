<?php

/**************************************************************/
/*                                                            */
/* File: 2022_11_16_104544_create_users_memberships_table.php */
/* Author: David Chocholaty <xbartu11@stud.fit.vutbr.cz>      */
/* Project: Project for the course ITU                        */
/* Description: The migration for creating the users          */
/*              memberships table.                            */
/*                                                            */
/**************************************************************/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * The migration for creating the users memberships table.
 */
class CreateUsersMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_memberships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onUpdate('cascade')
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
        Schema::dropIfExists('users_memberships');
    }
}
