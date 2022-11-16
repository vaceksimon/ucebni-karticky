<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('degree_front')->nullable();
            $table->string('degree_after')->nullable();
            $table->dropColumn('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('school')->nullable();
            $table->string('photo')->nullable();
            $table->enum('type', ['admin', 'teacher', 'student']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('degree_front');
            $table->dropColumn('degree_after');
            $table->string('name');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('school');
            $table->dropColumn('photo');
            $table->dropColumn('type');
        });
    }
}
